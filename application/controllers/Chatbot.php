<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatbot extends Admin_Controller
{
    // mAIN
    private $gemini_api_key = '';

    private $gemini_model   = 'gemini-3-flash-preview';

    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
    }

    public function ask()
    {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        $old_error_reporting = error_reporting(0);
        $old_display_errors  = ini_get('display_errors');
        ini_set('display_errors', '0');

        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: no-store');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['error' => 'Method not allowed.']);
            exit;
        }

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }

        $raw = file_get_contents('php://input');
        if (empty(trim($raw))) {
            $raw = json_encode([
                'message' => isset($_POST['message']) ? $_POST['message'] : '',
                'history' => []
            ]);
        }

        $payload = json_decode($raw, true);
        $message = isset($payload['message']) ? trim((string)$payload['message']) : '';
        $history = (isset($payload['history']) && is_array($payload['history'])) ? $payload['history'] : [];

        if ($message === '') {
            echo json_encode(['error' => 'Message cannot be empty.']);
            exit;
        }

        $db_context = '';
        try {
            $db_context = $this->_build_db_context();
        } catch (Exception $e) {
            $db_context = 'Database context unavailable: ' . $e->getMessage();
        }

        $system_prompt = $this->_build_system_prompt($db_context);

        $contents = [];

        foreach ($history as $turn) {
            if (!isset($turn['role'], $turn['text'])) continue;
            $role = ($turn['role'] === 'user') ? 'user' : 'model';
            $contents[] = ['role' => $role, 'parts' => [['text' => (string)$turn['text']]]];
        }

        $contents[] = ['role' => 'user', 'parts' => [['text' => $message]]];

        $request_body = [
            'systemInstruction' => [
                'parts' => [['text' => $system_prompt]]
            ],
            'contents'         => $contents,
            'generationConfig' => [
                'temperature'     => 0.7,
                'maxOutputTokens' => 4096,
            ]
        ];

        if (!function_exists('curl_init')) {
            echo json_encode(['error' => 'cURL extension is not enabled on this server.']);
            exit;
        }

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/'
             . $this->gemini_model
             . ':generateContent?key='
             . $this->gemini_api_key;

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($request_body),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response    = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_err    = curl_error($ch);
        curl_close($ch);

        // ── 10. Handle errors ───────────────────────────────────────────
        if ($curl_err) {
            echo json_encode(['error' => 'Network error connecting to Gemini: ' . $curl_err]);
            exit;
        }

        if (empty($response)) {
            echo json_encode(['error' => 'Gemini returned an empty response (HTTP ' . $http_status . ').']);
            exit;
        }

        $resp = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['error' => 'Gemini returned non-JSON (HTTP ' . $http_status . '): ' . substr($response, 0, 150)]);
            exit;
        }

        // Rate-limit / API error
        if (isset($resp['error'])) {
            $msg    = isset($resp['error']['message']) ? $resp['error']['message'] : 'Unknown Gemini error.';
            $code   = isset($resp['error']['code'])   ? (int)$resp['error']['code']   : $http_status;
            if ($code === 429) {
                $msg = 'The AI is busy right now (rate limit). Please wait a moment and try again.';
            }
            echo json_encode(['error' => $msg]);
            exit;
        }

        if (!isset($resp['candidates'][0]['content']['parts'][0]['text'])) {
            echo json_encode(['error' => 'Unexpected Gemini response structure (HTTP ' . $http_status . ').']);
            exit;
        }

        // ── 11. Success ─────────────────────────────────────────────────
        $answer = $resp['candidates'][0]['content']['parts'][0]['text'];

        // Restore error settings
        error_reporting($old_error_reporting);
        ini_set('display_errors', $old_display_errors);

        echo json_encode(['reply' => $answer]);
        exit;
    }

    /**
     * GET /chatbot/get_dashboard_summary
     * Returns an AI-generated summary and recommendation based on the dashboard stats.
     */
    public function get_dashboard_summary()
    {
        while (ob_get_level() > 0) ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: no-store');

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }

        $db_context = '';
        try {
            $db_context = $this->_build_db_context();
        } catch (Exception $e) {
            $db_context = 'Database context unavailable.';
        }

        $system_prompt = "You are an expert AI agricultural analyst for the MEB Beekeeping Management System.\n\n"
                       . "Here is the current raw data:\n" . $db_context . "\n\n"
                       . "Instructions:\n"
                       . "1. Provide a very brief overview of the colonies and production.\n"
                       . "2. Give 1 clear, actionable recommendation for the beekeepers on how to handle the ratio of active vs inactive colonies.\n"
                       . "3. CRITICAL: Your entire response MUST be extremely concise, strictly between 60 to 70 words in length. Do not exceed this limit.\n"
                       . "4. DO NOT output Markdown formatting like **bold** or *italics*. Use plain text only.";

        $request_body = [
            'contents' => [
                ['role' => 'user', 'parts' => [['text' => $system_prompt]]]
            ],
            'generationConfig' => [
                'temperature'     => 0.6,
                'maxOutputTokens' => 2048,
            ]
        ];

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/' . $this->gemini_model . ':generateContent?key=' . $this->gemini_api_key;
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($request_body),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        if (empty($response)) {
            echo json_encode(['summary' => 'Unable to connect to the AI at this time.']);
            exit;
        }

        $resp = json_decode($response, true);
        if (isset($resp['candidates'][0]['content']['parts'][0]['text'])) {
            $summary = trim($resp['candidates'][0]['content']['parts'][0]['text']);
            echo json_encode(['summary' => $summary]);
        } else {
            echo json_encode(['summary' => 'The AI is currently processing other requests. Please try again later.']);
        }
    }

    private function _build_db_context()
    {
        $old_db_debug = (isset($this->db->db_debug)) ? $this->db->db_debug : TRUE;
        $this->db->db_debug = FALSE;

        $ctx = [];

        // KPIs
        $r = $this->db->query("SELECT COUNT(*) AS cnt FROM beekeeper WHERE active = 1")->row_array();
        $ctx[] = "Active beekeepers: " . intval($r['cnt']);

        $r = $this->db->query("SELECT COALESCE(SUM(total_colony), 0) AS cnt FROM colony")->row_array();
        $ctx[] = "Total colonies: " . intval($r['cnt']);

        $r = $this->db->query("SELECT COUNT(*) AS cnt FROM apiary")->row_array();
        $ctx[] = "Total apiaries: " . intval($r['cnt']);

        $r = $this->db->query("SELECT COALESCE(SUM(total_production),0) AS t FROM production WHERE YEAR(production_date)=YEAR(CURDATE())")->row_array();
        $ctx[] = "Honey production this year: " . number_format((float)$r['t'], 2) . " kg";

        $r = $this->db->query("SELECT COALESCE(SUM(total_production),0) AS t FROM production")->row_array();
        $ctx[] = "All-time honey production: " . number_format((float)$r['t'], 2) . " kg";

        // Satellite Centers
        $r = $this->db->query("SELECT COUNT(*) AS cnt FROM satellite_centers")->row_array();
        $ctx[] = "Total satellite centers: " . intval($r['cnt']);

        $rows = $this->db->query(
            "SELECT sc.satellite_name, mu.citymunDesc AS municipality, pr.provDesc AS province
             FROM satellite_centers sc
             LEFT JOIN municipality mu ON sc.municipality_id = mu.municipality_id
             LEFT JOIN province pr     ON sc.province_id     = pr.province_id
             ORDER BY sc.id DESC"
        )->result_array();
        if ($rows) {
            $lines = [];
            foreach ($rows as $row) { $lines[] = "  - {$row['satellite_name']} | {$row['municipality']}, {$row['province']}"; }
            $ctx[] = "Satellite Centers:\n" . implode("\n", $lines);
        }

        // Monitoring
        $r = $this->db->query("SELECT COUNT(*) AS cnt FROM monitoring")->row_array();
        $ctx[] = "Total monitoring logs: " . intval($r['cnt']);

        $rows = $this->db->query(
            "SELECT m.action, m.observation, m.monitoring_date, a.location
             FROM monitoring m
             JOIN apiary a ON m.apiary_id = a.id
             ORDER BY m.monitoring_date DESC, m.id DESC LIMIT 15"
        )->result_array();
        if ($rows) {
            $lines = [];
            foreach ($rows as $row) { 
                $d = !empty($row['monitoring_date']) ? date('M d, Y', strtotime($row['monitoring_date'])) : 'Unknown Date';
                $lines[] = "  - [{$d}] {$row['location']} | Action: ".ucfirst($row['action'])." | Observation: {$row['observation']}"; 
            }
            $ctx[] = "Recent Monitoring Activities:\n" . implode("\n", $lines);
        }

        // Top beekeepers
        $rows = $this->db->query(
            "SELECT b.beekeeper_name, COALESCE(SUM(p.total_production),0) AS prod
             FROM beekeeper b
             LEFT JOIN apiary a  ON a.beekeeper_id = b.id
             LEFT JOIN colony c  ON c.apiary_id    = a.id
             LEFT JOIN production p ON p.colony_id = c.id
             GROUP BY b.id, b.beekeeper_name ORDER BY prod DESC LIMIT 10"
        )->result_array();
        if ($rows) {
            $lines = [];
            foreach ($rows as $row) {
                $lines[] = "  - {$row['beekeeper_name']}: " . number_format((float)$row['prod'], 2) . " kg";
            }
            $ctx[] = "Top beekeepers by production:\n" . implode("\n", $lines);
        }

        // Apiaries
        $rows = $this->db->query(
            "SELECT a.location, b.beekeeper_name,
                    mu.citymunDesc AS municipality, pr.provDesc AS province,
                    (SELECT COUNT(*) FROM colony c WHERE c.apiary_id = a.id) AS colonies
             FROM apiary a
             JOIN beekeeper b ON a.beekeeper_id = b.id
             LEFT JOIN municipality mu ON a.municipality_id = mu.municipality_id
             LEFT JOIN province pr     ON a.province_id     = pr.province_id
             ORDER BY colonies DESC LIMIT 20"
        )->result_array();
        if ($rows) {
            $lines = [];
            foreach ($rows as $row) {
                $lines[] = "  - \"{$row['location']}\" | {$row['beekeeper_name']} | {$row['municipality']}, {$row['province']} | {$row['colonies']} colonies";
            }
            $ctx[] = "Apiaries (top 20):\n" . implode("\n", $lines);
        }

        // Species
        $rows = $this->db->query(
            "SELECT s.name AS species, COUNT(*) AS cnt
             FROM colony c LEFT JOIN species s ON c.species_id = s.id
             GROUP BY s.id, s.name ORDER BY cnt DESC"
        )->result_array();
        if ($rows) {
            $lines = [];
            foreach ($rows as $row) { $lines[] = "  - {$row['species']}: {$row['cnt']}"; }
            $ctx[] = "Colonies by species:\n" . implode("\n", $lines);
        }

        // Production by year
        $rows = $this->db->query(
            "SELECT YEAR(production_date) AS yr, COALESCE(SUM(total_production),0) AS t
             FROM production GROUP BY yr ORDER BY yr DESC LIMIT 8"
        )->result_array();
        if ($rows) {
            $lines = [];
            foreach ($rows as $row) { $lines[] = "  - {$row['yr']}: " . number_format((float)$row['t'], 2) . " kg"; }
            $ctx[] = "Production by year:\n" . implode("\n", $lines);
        }

        // Production by municipality
        $rows = $this->db->query(
            "SELECT mu.citymunDesc AS municipality, COALESCE(SUM(p.total_production),0) AS t
             FROM production p
             JOIN colony c  ON p.colony_id = c.id
             JOIN apiary a  ON c.apiary_id = a.id
             LEFT JOIN municipality mu ON a.municipality_id = mu.municipality_id
             GROUP BY mu.municipality_id, mu.citymunDesc ORDER BY t DESC LIMIT 10"
        )->result_array();
        if ($rows) {
            $lines = [];
            foreach ($rows as $row) { $lines[] = "  - {$row['municipality']}: " . number_format((float)$row['t'], 2) . " kg"; }
            $ctx[] = "Production by municipality:\n" . implode("\n", $lines);
        }

        // Production by product
        try {
            $rows = $this->db->query(
                "SELECT pr.name AS product_name, 
                        COALESCE(SUM(p.total_production), 0) AS total_kg,
                        COALESCE(SUM(p.gross_income), 0) AS gross,
                        COALESCE(SUM(p.net_income), 0) AS net
                 FROM production p
                 JOIN product pr ON p.product_id = pr.id
                 GROUP BY pr.id, pr.name
                 ORDER BY total_kg DESC"
            )->result_array();
            if ($rows) {
                $lines = [];
                foreach ($rows as $row) {
                    $lines[] = "  - {$row['product_name']}: " . number_format((float)$row['total_kg'], 2) . " kg (Gross: ₱" . number_format((float)$row['gross'], 2) . ", Net: ₱" . number_format((float)$row['net'], 2) . ")";
                }
                $ctx[] = "Production by product:\n" . implode("\n", $lines);
            }
        } catch (Exception $e) {}

        // Latest posts
        try {
            $rows = $this->db->query(
                "SELECT post_title AS title, DATE_FORMAT(updated_date,'%Y-%m-%d') AS posted
                 FROM post ORDER BY updated_date DESC LIMIT 5"
            )->result_array();
            if ($rows) {
                $lines = [];
                foreach ($rows as $row) { $lines[] = "  - [{$row['posted']}] {$row['title']}"; }
                $ctx[] = "Latest news:\n" . implode("\n", $lines);
            }
        } catch (Exception $e) {}

        // Associations
        $rows = $this->db->query("SELECT association_name FROM association ORDER BY association_name LIMIT 20")->result_array();
        if ($rows) {
            $ctx[] = "Associations: " . implode(', ', array_column($rows, 'association_name'));
        }

        $this->db->db_debug = $old_db_debug;
        return implode("\n\n", $ctx);
    }

    private function _build_system_prompt($db_context)
    {
        $now = date('F j, Y g:i A');
        $p  = "You are the MEB Beekeeping AI Assistant — an expert embedded inside the Municipal Extension Bureau (MEB) Beekeeping Management System, La Union, Philippines.\n\n";
        $p .= "Current date/time: {$now}\n\n";
        $p .= "Instructions:\n";
        $p .= "- Use the DATABASE SNAPSHOT below as the primary source of truth for MEB-specific data.\n";
        $p .= "- For questions not covered by the database (general beekeeping, diseases, best practices), use your knowledge and say so.\n";
        $p .= "- Format answers with bullet points or numbered lists when helpful.\n";
        $p .= "- Be friendly, concise, and professional. Use kg for weight.\n\n";
        $p .= "=== LIVE DATABASE SNAPSHOT ===\n" . $db_context . "\n=== END SNAPSHOT ===\n";
        return $p;
    }
}
