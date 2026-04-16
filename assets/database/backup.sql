#
# TABLE STRUCTURE FOR: alumni
#

DROP TABLE IF EXISTS `alumni`;

CREATE TABLE `alumni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) NOT NULL,
  `batch` varchar(50) DEFAULT NULL,
  `month_year_graduated` varchar(50) DEFAULT NULL,
  `degree_earned` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `telephone_number` varchar(20) DEFAULT NULL,
  `cellular_number` varchar(20) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `facebook_account` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_relationship` varchar(50) DEFAULT NULL,
  `guardian_address` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_tel` varchar(20) DEFAULT NULL,
  `emergency_contact_cp` varchar(20) DEFAULT NULL,
  `employment_status` enum('employed','unemployed','other') DEFAULT NULL,
  `review_center` varchar(50) DEFAULT NULL,
  `date_of_examination` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `eligibility` varchar(255) DEFAULT NULL,
  `current_work_position` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `alumni` (`id`, `student_id`, `batch`, `month_year_graduated`, `degree_earned`, `age`, `date_of_birth`, `place_of_birth`, `current_address`, `permanent_address`, `telephone_number`, `cellular_number`, `email_address`, `facebook_account`, `mother_name`, `mother_occupation`, `father_name`, `father_occupation`, `guardian_name`, `guardian_relationship`, `guardian_address`, `emergency_contact_name`, `emergency_contact_tel`, `emergency_contact_cp`, `employment_status`, `review_center`, `date_of_examination`, `updated_at`, `created_at`, `eligibility`, `current_work_position`, `company_name`, `location`) VALUES (11, '2021-00002', 'Nulla dolores dolore', '6', 'Blanditiis molestiae', 26, '1999-08-16', 'Ut vel est possimus', 'Sevilla San Fernando La Union', 'Sevilla San Fernando La Union', '+1 (261) 393-2491', '109', 'symizalahy@mailinator.com', 'Beatae qui iusto bla', 'Levi Church', 'Perspiciatis perspi', 'James Suarez', 'Qui dolor quia volup', 'Erlinda De Guzman', 'Rem facere praesenti', 'Ut distinctio Sed d', 'Cole Moore', 'Autem est ipsum faci', 'Sed laboriosam est', 'other', '', '2000-05-12', NULL, '2026-02-27 14:36:25', 'Aperiam corporis off', 'Dolore ipsum quia u', 'Robles Short Inc', 'Odio possimus sapie');
INSERT INTO `alumni` (`id`, `student_id`, `batch`, `month_year_graduated`, `degree_earned`, `age`, `date_of_birth`, `place_of_birth`, `current_address`, `permanent_address`, `telephone_number`, `cellular_number`, `email_address`, `facebook_account`, `mother_name`, `mother_occupation`, `father_name`, `father_occupation`, `guardian_name`, `guardian_relationship`, `guardian_address`, `emergency_contact_name`, `emergency_contact_tel`, `emergency_contact_cp`, `employment_status`, `review_center`, `date_of_examination`, `updated_at`, `created_at`, `eligibility`, `current_work_position`, `company_name`, `location`) VALUES (12, '2021-00002', 'Iure labore impedit', '11', 'Voluptatibus fugiat', 26, '1999-08-16', 'Esse dolor porro vi', 'Sevilla San Fernando La Union', 'Sevilla San Fernando La Union', '+1 (466) 498-5489', '657', 'mebedo@mailinator.com', 'Iusto dolor natus no', 'Bianca Cummings', 'Modi cillum et sed d', 'Kaitlin Frederick', 'Enim animi qui et a', 'Erlinda De Guzman', 'Quo reiciendis adipi', 'Dolores est nostrud', 'Emmanuel Rivas', 'Numquam est saepe qu', 'Mollitia modi doloru', 'unemployed', 'Ut et tempora in ex', '1981-01-26', NULL, '2026-02-27 14:38:27', 'Aperiam suscipit ad', 'Fugiat quasi dolore', 'Cantu and Pate Trading', 'In dolorem labore qu');


#
# TABLE STRUCTURE FOR: alumni_employment_history
#

DROP TABLE IF EXISTS `alumni_employment_history`;

CREATE TABLE `alumni_employment_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alumni_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `position_title` varchar(150) NOT NULL,
  `employment_type` varchar(100) NOT NULL,
  `employment_status` enum('current','past') NOT NULL DEFAULT 'current',
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_alumni_employment_alumni` (`alumni_id`),
  CONSTRAINT `fk_alumni_employment_alumni` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# TABLE STRUCTURE FOR: clinic_patients
#

DROP TABLE IF EXISTS `clinic_patients`;

CREATE TABLE `clinic_patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_year` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL,
  `blood_pressure` varchar(50) DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `pulse` varchar(50) DEFAULT NULL,
  `respiration` varchar(50) DEFAULT NULL,
  `chief_complaint` text DEFAULT NULL,
  `present_illness` text DEFAULT NULL,
  `past_history` text DEFAULT NULL,
  `family_history` text DEFAULT NULL,
  `social_history` text DEFAULT NULL,
  `ob_history` text DEFAULT NULL,
  `general_exam` text DEFAULT NULL,
  `skin_exam` text DEFAULT NULL,
  `eyes_exam` text DEFAULT NULL,
  `ears_exam` text DEFAULT NULL,
  `nose_exam` text DEFAULT NULL,
  `mouth_exam` text DEFAULT NULL,
  `neck_exam` text DEFAULT NULL,
  `abdomen_exam` text DEFAULT NULL,
  `others_exam` text DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `medication` text DEFAULT NULL,
  `follow_up` text DEFAULT NULL,
  `status` enum('Active','Archived') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `clinic_patients` (`id`, `student_id`, `course_year`, `age`, `height`, `temperature`, `blood_pressure`, `sex`, `weight`, `pulse`, `respiration`, `chief_complaint`, `present_illness`, `past_history`, `family_history`, `social_history`, `ob_history`, `general_exam`, `skin_exam`, `eyes_exam`, `ears_exam`, `nose_exam`, `mouth_exam`, `neck_exam`, `abdomen_exam`, `others_exam`, `diagnosis`, `treatment`, `medication`, `follow_up`, `status`, `created_at`, `updated_at`) VALUES (14, 13, 'BSCS 4th Year', 25, 157, 0, '', 'Female', 59, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Active', '2026-02-10 10:49:27', NULL);
INSERT INTO `clinic_patients` (`id`, `student_id`, `course_year`, `age`, `height`, `temperature`, `blood_pressure`, `sex`, `weight`, `pulse`, `respiration`, `chief_complaint`, `present_illness`, `past_history`, `family_history`, `social_history`, `ob_history`, `general_exam`, `skin_exam`, `eyes_exam`, `ears_exam`, `nose_exam`, `mouth_exam`, `neck_exam`, `abdomen_exam`, `others_exam`, `diagnosis`, `treatment`, `medication`, `follow_up`, `status`, `created_at`, `updated_at`) VALUES (15, 16, 'BSCS 3rd Year', 20, 0, 0, '', 'Female', 60, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Active', '2026-02-12 08:35:21', NULL);


#
# TABLE STRUCTURE FOR: consultations
#

DROP TABLE IF EXISTS `consultations`;

CREATE TABLE `consultations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `counselling_sessions_id` int(11) NOT NULL COMMENT 'One to one: Counselling Sessions Table',
  `consult_summary` varchar(255) NOT NULL,
  `consultation_date` text DEFAULT NULL,
  `consultation_time_started` time DEFAULT NULL,
  `consultation_time_ended` time NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `consultations` (`id`, `counselling_sessions_id`, `consult_summary`, `consultation_date`, `consultation_time_started`, `consultation_time_ended`, `created_at`, `updated_at`) VALUES (4, 10, 'Molestiae tempor dolorum officiis exercitation mollit mollit dolores reprehenderit fugiat tenetur ratione in nulla ea', '2026-02-26', '10:50:00', '10:53:00', '2026-02-26 10:50:14', '2026-02-26 10:50:14');


#
# TABLE STRUCTURE FOR: counselling_sessions
#

DROP TABLE IF EXISTS `counselling_sessions`;

CREATE TABLE `counselling_sessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `referred_by` int(11) NOT NULL,
  `student_concern` varchar(200) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `facilitator_user_id` int(10) unsigned DEFAULT NULL,
  `scheduled_at` datetime NOT NULL,
  `duration_minutes` smallint(5) unsigned NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `session_no` varchar(50) NOT NULL,
  `status` enum('Scheduled','Ongoing','Completed','Cancelled') NOT NULL DEFAULT 'Scheduled',
  `category` enum('Group','Individual') NOT NULL COMMENT 'Same table with individaul counselling',
  `followup_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_group_sessions_scheduled_at` (`scheduled_at`),
  KEY `idx_group_sessions_status` (`status`),
  KEY `idx_group_sessions_facilitator` (`facilitator_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `counselling_sessions` (`id`, `course_id`, `student_id`, `referred_by`, `student_concern`, `title`, `topic`, `description`, `facilitator_user_id`, `scheduled_at`, `duration_minutes`, `location`, `session_no`, `status`, `category`, `followup_date`, `created_at`, `updated_at`) VALUES (10, 5, 97, 77, NULL, NULL, NULL, 'Dolore in sint aute', 2, '2019-01-08 19:25:00', 94, NULL, '12', 'Scheduled', 'Individual', NULL, '2026-02-26 10:49:53', '2026-02-26 11:18:15');
INSERT INTO `counselling_sessions` (`id`, `course_id`, `student_id`, `referred_by`, `student_concern`, `title`, `topic`, `description`, `facilitator_user_id`, `scheduled_at`, `duration_minutes`, `location`, `session_no`, `status`, `category`, `followup_date`, `created_at`, `updated_at`) VALUES (11, 0, NULL, 0, NULL, NULL, NULL, 'Sint omnis quasi au', 2, '2014-02-14 12:10:00', 30, 'Commodi pariatur Ut', 'Test', 'Scheduled', 'Group', NULL, '2026-02-26 11:19:14', '2026-02-26 11:50:14');


#
# TABLE STRUCTURE FOR: courses
#

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0:active, 1:inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `courses` (`id`, `course`, `description`, `status`, `created_at`, `updated_at`) VALUES (2, 'BSCS', 'Bachelor of Science in Computer Science', 0, '2025-09-18 11:37:35', '0000-00-00 00:00:00');
INSERT INTO `courses` (`id`, `course`, `description`, `status`, `created_at`, `updated_at`) VALUES (3, 'BSHM', 'Bachelor of Hospitality Management', 0, '2025-10-17 13:00:28', '0000-00-00 00:00:00');
INSERT INTO `courses` (`id`, `course`, `description`, `status`, `created_at`, `updated_at`) VALUES (4, 'BSCRIM', 'Bachelor of Science in Criminology', 0, '2025-10-17 13:00:47', '0000-00-00 00:00:00');
INSERT INTO `courses` (`id`, `course`, `description`, `status`, `created_at`, `updated_at`) VALUES (5, 'HMT', 'Hospitality Management Technology', 0, '2025-10-17 13:01:04', '0000-00-00 00:00:00');
INSERT INTO `courses` (`id`, `course`, `description`, `status`, `created_at`, `updated_at`) VALUES (6, 'Basic Ed', 'Basic Education', 0, '2025-10-17 13:01:17', '0000-00-00 00:00:00');


#
# TABLE STRUCTURE FOR: dental_patients
#

DROP TABLE IF EXISTS `dental_patients`;

CREATE TABLE `dental_patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) NOT NULL,
  `academic_year` varchar(20) NOT NULL DEFAULT '2025-2026',
  `examination_date` date NOT NULL,
  `oral_prophylaxis` tinyint(1) DEFAULT 0,
  `oral_prophylaxis_tooth` varchar(50) DEFAULT NULL,
  `dental_extraction` tinyint(1) DEFAULT 0,
  `dental_extraction_tooth` varchar(50) DEFAULT NULL,
  `restorative_filling` tinyint(1) DEFAULT 0,
  `restorative_filling_tooth` varchar(50) DEFAULT NULL,
  `pit_fissure_sealant` tinyint(1) DEFAULT 0,
  `pit_fissure_sealant_tooth` varchar(50) DEFAULT NULL,
  `orthodontic_treatment` tinyint(1) DEFAULT 0,
  `orthodontic_treatment_tooth` varchar(50) DEFAULT NULL,
  `prosthesis` tinyint(1) DEFAULT 0,
  `prosthesis_tooth` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `examiner_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `dental_patients` (`id`, `student_id`, `academic_year`, `examination_date`, `oral_prophylaxis`, `oral_prophylaxis_tooth`, `dental_extraction`, `dental_extraction_tooth`, `restorative_filling`, `restorative_filling_tooth`, `pit_fissure_sealant`, `pit_fissure_sealant_tooth`, `orthodontic_treatment`, `orthodontic_treatment_tooth`, `prosthesis`, `prosthesis_tooth`, `remarks`, `examiner_name`, `created_at`, `updated_at`, `is_deleted`) VALUES (7, '45', '1988', '1994-08-15', 1, 'Test', 1, '', 0, '', 0, '', 1, '', 1, '', 'Cillum animi volupt', 'Octavia Rollins', '2026-02-22 14:41:25', '2026-02-22 14:41:51', NULL);


#
# TABLE STRUCTURE FOR: employed_alumni
#

DROP TABLE IF EXISTS `employed_alumni`;

CREATE TABLE `employed_alumni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) NOT NULL COMMENT 'Student ID from students table',
  `cellphone_number` varchar(20) DEFAULT NULL,
  `telephone_number` varchar(20) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `field_of_work` enum('PNP','BJMP','BFP','PHILIPPINE ARMY','PHILIPPINE NAVY','PHILIPPINE COAST GUARD','SELF EMPLOYED','OTHERS') DEFAULT NULL,
  `field_of_work_others` varchar(255) DEFAULT NULL COMMENT 'Specify if field_of_work is OTHERS',
  `job_title_position` varchar(255) DEFAULT NULL,
  `last_examination` enum('Criminologist Licensure Examination','NAPO/LCOM Entrance Exam','Career Service Examination','N/A') DEFAULT NULL,
  `examination_month_year` varchar(50) DEFAULT NULL COMMENT 'Month and year of last examination',
  `license_registered_criminologist` tinyint(1) DEFAULT 0 COMMENT 'Registered criminologist',
  `license_napo_lcom_eligibility` tinyint(1) DEFAULT 0 COMMENT 'NAPO/LCOM Eligibility',
  `license_civil_service_eligibility` tinyint(1) DEFAULT 0 COMMENT 'Civil Service Eligibility',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# TABLE STRUCTURE FOR: fresh_graduates
#

DROP TABLE IF EXISTS `fresh_graduates`;

CREATE TABLE `fresh_graduates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) NOT NULL COMMENT 'Student ID from students table',
  `cellphone_number` varchar(20) DEFAULT NULL,
  `telephone_number` varchar(20) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `review_center` enum('CBRC','CCRC','RRC','ARC') DEFAULT NULL COMMENT 'Carl Balita Review center, Crim Chat Review Center, Remarkable Review Center, Amici Review Center',
  `address` text DEFAULT NULL,
  `date_of_examination` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `fresh_graduates` (`id`, `student_id`, `cellphone_number`, `telephone_number`, `email_address`, `review_center`, `address`, `date_of_examination`, `created_at`, `updated_at`) VALUES (1, '6546-46653', '09295033173', '0954353335442', 'K@GMAIL.COM', '', 'bacnotan, la union', NULL, '2025-11-13 16:21:45', '2025-11-13 16:21:45');


#
# TABLE STRUCTURE FOR: gad_profiles
#

DROP TABLE IF EXISTS `gad_profiles`;

CREATE TABLE `gad_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `age` smallint(5) unsigned NOT NULL,
  `grade_section_course_year` varchar(150) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `present_address` varchar(255) NOT NULL,
  `sexual_orientation` enum('Straight Male','Straight Female','Lesbian','Gay','Bisexual','Queer','Transgender','Intersex','Pansexual','Asexual','Other') NOT NULL,
  `civil_status` enum('Single','Married','Widow','Legally Separated','Annulled','Separated','Other') NOT NULL,
  `religious_affiliation` enum('Baptist','Christian','Evangelist','Hinduism','Iglesia ni Cristo','Islam','Jehovah''s Witnesses','Protestant','Catholic Church','Others') NOT NULL,
  `indigenous_group` enum('Aeta','Bontoc','Ibaloi','Igorot','Iloco','Kankanaey','Negrito','Cebuano','Hiligaynon','Lumad','Mangyan','Molbog','Visayans','Waray-waray','Badjao','Muslim','Others') NOT NULL,
  `family_type` enum('Extended Family','Nuclear Family','Single Parent','Others') NOT NULL,
  `combined_family_income` enum('less than 3,000','5,000-10,000','11,000-15,000','16,000-20,000','21,000-25,000','26,000-30,000','Others') NOT NULL,
  `family_provider` enum('Father','Mother','Both Parents') NOT NULL,
  `income_source` enum('Business','Commission','Domestic Work','Government Job','Private','Others') NOT NULL,
  `needs_adequacy` enum('more than adequate','adequate','not adequate','Others') NOT NULL,
  `mother_is_ofw` enum('YES','NO','Others') NOT NULL,
  `mother_ofw_workplace` varchar(150) DEFAULT NULL,
  `mother_ofw_nature_of_work` varchar(150) DEFAULT NULL,
  `mother_ofw_years` smallint(5) unsigned DEFAULT NULL,
  `father_is_ofw` enum('YES','NO','Others') NOT NULL,
  `father_ofw_workplace` varchar(150) DEFAULT NULL,
  `father_ofw_nature_of_work` varchar(150) DEFAULT NULL,
  `father_ofw_years` smallint(5) unsigned DEFAULT NULL,
  `father_name` varchar(150) NOT NULL,
  `mother_name` varchar(150) NOT NULL,
  `father_occupation` varchar(150) NOT NULL,
  `mother_occupation` varchar(150) NOT NULL,
  `is_academic_scholar` enum('YES','NO') NOT NULL,
  `scholarship_type` varchar(150) DEFAULT NULL,
  `has_study_support` enum('YES','NO') NOT NULL,
  `study_support_by` varchar(150) DEFAULT NULL,
  `sports_good_at` varchar(150) DEFAULT NULL,
  `is_varsity_player` enum('YES','NO') DEFAULT NULL,
  `varsity_sport` varchar(150) DEFAULT NULL,
  `has_external_awards` enum('YES','NO') DEFAULT NULL,
  `external_awards_details` varchar(255) DEFAULT NULL,
  `is_working_student` enum('YES','NO') DEFAULT NULL,
  `job_title` varchar(150) DEFAULT NULL,
  `work_frequency_per_week` varchar(50) DEFAULT NULL,
  `salary_rate` varchar(50) DEFAULT NULL,
  `hp_physically_challenged` tinyint(1) NOT NULL DEFAULT 0,
  `hp_hypertension` tinyint(1) NOT NULL DEFAULT 0,
  `hp_heart_ailment` tinyint(1) NOT NULL DEFAULT 0,
  `hp_cancer` tinyint(1) NOT NULL DEFAULT 0,
  `hp_asthma` tinyint(1) NOT NULL DEFAULT 0,
  `hp_diabetes` tinyint(1) NOT NULL DEFAULT 0,
  `hp_migraine` tinyint(1) NOT NULL DEFAULT 0,
  `hp_eye_problem` tinyint(1) NOT NULL DEFAULT 0,
  `hp_anxiety` tinyint(1) NOT NULL DEFAULT 0,
  `hp_depression` tinyint(1) NOT NULL DEFAULT 0,
  `hp_others` varchar(255) DEFAULT NULL,
  `is_breadwinner` enum('YES','NO') DEFAULT NULL,
  `breadwinner_income_source` varchar(150) DEFAULT NULL,
  `has_access_to_family_finances` enum('YES','NO') DEFAULT NULL,
  `participates_in_family_decisions` enum('YES','NO') DEFAULT NULL,
  `family_observes_house_rules` enum('YES','NO') DEFAULT NULL,
  `house_rules_details` varchar(255) DEFAULT NULL,
  `participates_household_tasks` enum('YES','NO') DEFAULT NULL,
  `decides_household_affairs` enum('YES','NO') DEFAULT NULL,
  `active_in_orgs` enum('YES','NO') DEFAULT NULL,
  `organizations_names` varchar(255) DEFAULT NULL,
  `exercises_right_to_vote` enum('YES','NO') DEFAULT NULL,
  `active_community_member` enum('YES','NO') DEFAULT NULL,
  `is_sk_kagawad` enum('YES','NO') DEFAULT NULL,
  `other_positions` varchar(255) DEFAULT NULL,
  `owns_house_property` enum('YES','NO') DEFAULT NULL,
  `has_regular_checkups` enum('YES','NO') DEFAULT NULL,
  `attends_religious_gathering_with_family` enum('YES','NO') DEFAULT NULL,
  `has_regular_recreation` enum('YES','NO') DEFAULT NULL,
  `has_enough_rest` enum('YES','NO') DEFAULT NULL,
  `manages_stress_well` enum('YES','NO') DEFAULT NULL,
  `stress_management_how` varchar(255) DEFAULT NULL,
  `joins_empowering_activities` enum('YES','NO') DEFAULT NULL,
  `home_env_supports_growth` enum('YES','NO') DEFAULT NULL,
  `exp_physical_harm` enum('YES','NO') DEFAULT NULL,
  `exp_threats_physical_harm` enum('YES','NO') DEFAULT NULL,
  `exp_fear_imminent_harm` enum('YES','NO') DEFAULT NULL,
  `exp_psych_abuse_infidelity` enum('YES','NO') DEFAULT NULL,
  `exp_stalked` enum('YES','NO') DEFAULT NULL,
  `exp_harassed` enum('YES','NO') DEFAULT NULL,
  `exp_verbal_emotional_abuse` enum('YES','NO') DEFAULT NULL,
  `exp_mental_emotional_abuse` enum('YES','NO') DEFAULT NULL,
  `exp_public_humiliation` enum('YES','NO') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_gad_student` (`student_id`),
  CONSTRAINT `fk_gad_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gad_profiles` (`id`, `student_id`, `email`, `age`, `grade_section_course_year`, `permanent_address`, `present_address`, `sexual_orientation`, `civil_status`, `religious_affiliation`, `indigenous_group`, `family_type`, `combined_family_income`, `family_provider`, `income_source`, `needs_adequacy`, `mother_is_ofw`, `mother_ofw_workplace`, `mother_ofw_nature_of_work`, `mother_ofw_years`, `father_is_ofw`, `father_ofw_workplace`, `father_ofw_nature_of_work`, `father_ofw_years`, `father_name`, `mother_name`, `father_occupation`, `mother_occupation`, `is_academic_scholar`, `scholarship_type`, `has_study_support`, `study_support_by`, `sports_good_at`, `is_varsity_player`, `varsity_sport`, `has_external_awards`, `external_awards_details`, `is_working_student`, `job_title`, `work_frequency_per_week`, `salary_rate`, `hp_physically_challenged`, `hp_hypertension`, `hp_heart_ailment`, `hp_cancer`, `hp_asthma`, `hp_diabetes`, `hp_migraine`, `hp_eye_problem`, `hp_anxiety`, `hp_depression`, `hp_others`, `is_breadwinner`, `breadwinner_income_source`, `has_access_to_family_finances`, `participates_in_family_decisions`, `family_observes_house_rules`, `house_rules_details`, `participates_household_tasks`, `decides_household_affairs`, `active_in_orgs`, `organizations_names`, `exercises_right_to_vote`, `active_community_member`, `is_sk_kagawad`, `other_positions`, `owns_house_property`, `has_regular_checkups`, `attends_religious_gathering_with_family`, `has_regular_recreation`, `has_enough_rest`, `manages_stress_well`, `stress_management_how`, `joins_empowering_activities`, `home_env_supports_growth`, `exp_physical_harm`, `exp_threats_physical_harm`, `exp_fear_imminent_harm`, `exp_psych_abuse_infidelity`, `exp_stalked`, `exp_harassed`, `exp_verbal_emotional_abuse`, `exp_mental_emotional_abuse`, `exp_public_humiliation`, `created_at`, `updated_at`) VALUES (2, 13, 'marquezjonnamae07@gmail.com', 25, 'BSCS / Lingsat San Fernando / 4th Year', 'Guinaburan Balaoan La  Union', 'Lingsat San Fernando La Union', 'Bisexual', 'Single', 'Catholic Church', 'Iloco', 'Extended Family', '5,000-10,000', 'Both Parents', 'Others', 'adequate', 'NO', '', '', 0, 'NO', '', '', 0, 'Metriano V. Marquez', 'Josephine N. Marquez', 'Farmer', 'Brgy. Utility', 'YES', 'Paower', 'YES', 'Parents/Siblings', 'Basketball', 'NO', 'no', 'NO', '', 'NO', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'NO', '', 'YES', 'YES', 'YES', '', 'YES', 'YES', 'YES', '', 'YES', 'YES', 'YES', '', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', '', 'NO', 'YES', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', '2026-02-11 21:56:41', '2026-02-11 21:56:41');


#
# TABLE STRUCTURE FOR: group_counselling_participants
#

DROP TABLE IF EXISTS `group_counselling_participants`;

CREATE TABLE `group_counselling_participants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `attendance` enum('Invited','Confirmed','Attended','Absent') NOT NULL DEFAULT 'Invited',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_session_student` (`session_id`,`student_id`),
  KEY `idx_group_participants_student` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `group_counselling_participants` (`id`, `session_id`, `student_id`, `attendance`, `notes`, `created_at`, `updated_at`) VALUES (17, 11, 95, 'Invited', NULL, '2026-02-26 11:50:14', '2026-02-26 11:50:14');
INSERT INTO `group_counselling_participants` (`id`, `session_id`, `student_id`, `attendance`, `notes`, `created_at`, `updated_at`) VALUES (18, 11, 64, 'Invited', NULL, '2026-02-26 11:50:14', '2026-02-26 11:50:14');
INSERT INTO `group_counselling_participants` (`id`, `session_id`, `student_id`, `attendance`, `notes`, `created_at`, `updated_at`) VALUES (19, 11, 104, 'Invited', NULL, '2026-02-26 11:50:14', '2026-02-26 11:50:14');
INSERT INTO `group_counselling_participants` (`id`, `session_id`, `student_id`, `attendance`, `notes`, `created_at`, `updated_at`) VALUES (20, 11, 68, 'Invited', NULL, '2026-02-26 11:50:14', '2026-02-26 11:50:14');
INSERT INTO `group_counselling_participants` (`id`, `session_id`, `student_id`, `attendance`, `notes`, `created_at`, `updated_at`) VALUES (21, 11, 88, 'Invited', NULL, '2026-02-26 11:50:14', '2026-02-26 11:50:14');
INSERT INTO `group_counselling_participants` (`id`, `session_id`, `student_id`, `attendance`, `notes`, `created_at`, `updated_at`) VALUES (22, 11, 54, 'Invited', NULL, '2026-02-26 11:50:14', '2026-02-26 11:50:14');
INSERT INTO `group_counselling_participants` (`id`, `session_id`, `student_id`, `attendance`, `notes`, `created_at`, `updated_at`) VALUES (23, 11, 55, 'Invited', NULL, '2026-02-26 11:50:14', '2026-02-26 11:50:14');


#
# TABLE STRUCTURE FOR: ind_educ_bg
#

DROP TABLE IF EXISTS `ind_educ_bg`;

CREATE TABLE `ind_educ_bg` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inventory_id` bigint(20) unsigned NOT NULL,
  `level` enum('Kinder','Elementary','Secondary','') NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `year_graduated` varchar(50) DEFAULT NULL,
  `awards` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ind_educ_bg` (`id`, `inventory_id`, `level`, `school_name`, `year_graduated`, `awards`, `created_at`, `updated_at`) VALUES ('103', '11', 'Kinder', 'Sunt id nulla even', '1997', 'Deleniti nihil commo', '2026-02-22 12:54:44', '2026-02-22 12:54:44');
INSERT INTO `ind_educ_bg` (`id`, `inventory_id`, `level`, `school_name`, `year_graduated`, `awards`, `created_at`, `updated_at`) VALUES ('104', '11', 'Elementary', 'Dolor repudiandae om', '1985', 'Adipisci exercitatio', '2026-02-22 12:54:44', '2026-02-22 12:54:44');
INSERT INTO `ind_educ_bg` (`id`, `inventory_id`, `level`, `school_name`, `year_graduated`, `awards`, `created_at`, `updated_at`) VALUES ('105', '11', 'Secondary', 'Mollitia dolores vol', '2017', 'Tempore vel non ali', '2026-02-22 12:54:44', '2026-02-22 12:54:44');
INSERT INTO `ind_educ_bg` (`id`, `inventory_id`, `level`, `school_name`, `year_graduated`, `awards`, `created_at`, `updated_at`) VALUES ('109', '10', 'Kinder', 'Test', '0000', 'Test', '2026-02-22 13:02:28', '2026-02-22 13:02:28');
INSERT INTO `ind_educ_bg` (`id`, `inventory_id`, `level`, `school_name`, `year_graduated`, `awards`, `created_at`, `updated_at`) VALUES ('110', '10', 'Elementary', 'Test', '0000', 'Test', '2026-02-22 13:02:28', '2026-02-22 13:02:28');
INSERT INTO `ind_educ_bg` (`id`, `inventory_id`, `level`, `school_name`, `year_graduated`, `awards`, `created_at`, `updated_at`) VALUES ('111', '10', 'Secondary', 'Test', '0000', 'Test', '2026-02-22 13:02:28', '2026-02-22 13:02:28');
INSERT INTO `ind_educ_bg` (`id`, `inventory_id`, `level`, `school_name`, `year_graduated`, `awards`, `created_at`, `updated_at`) VALUES ('115', '12', 'Kinder', 'A culpa officiis es', '1997', 'Obcaecati magni inci', '2026-02-27 08:33:01', '2026-02-27 08:33:01');
INSERT INTO `ind_educ_bg` (`id`, `inventory_id`, `level`, `school_name`, `year_graduated`, `awards`, `created_at`, `updated_at`) VALUES ('116', '12', 'Elementary', 'Mollitia sed ducimus', '1980', 'Quis doloribus commo', '2026-02-27 08:33:01', '2026-02-27 08:33:01');
INSERT INTO `ind_educ_bg` (`id`, `inventory_id`, `level`, `school_name`, `year_graduated`, `awards`, `created_at`, `updated_at`) VALUES ('117', '12', 'Secondary', 'Et praesentium unde ', '1992', 'Sit optio irure ma', '2026-02-27 08:33:01', '2026-02-27 08:33:01');


#
# TABLE STRUCTURE FOR: ind_family_bg
#

DROP TABLE IF EXISTS `ind_family_bg`;

CREATE TABLE `ind_family_bg` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inventory_id` bigint(20) unsigned NOT NULL,
  `relation_type` enum('father','mother','guardian') NOT NULL,
  `name` varchar(150) NOT NULL,
  `educational_attainment` varchar(150) DEFAULT NULL,
  `occupation` varchar(150) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ind_family_bg` (`id`, `inventory_id`, `relation_type`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES ('25', '11', 'father', 'Eric Escobero', 'Id natus veritatis a', 'Barangay Captain', '09453723047', 'Ad esse sint tempor', '2026-02-22 12:54:44', '2026-02-22 12:54:44');
INSERT INTO `ind_family_bg` (`id`, `inventory_id`, `relation_type`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES ('26', '11', 'mother', 'Evelyn Andade Macanas', 'Illum harum duis co', 'Housewife', '09453723047', 'Vel autem in in ut n', '2026-02-22 12:54:44', '2026-02-22 12:54:44');
INSERT INTO `ind_family_bg` (`id`, `inventory_id`, `relation_type`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES ('27', '11', 'guardian', 'Hakeem Randolph', 'Omnis neque eligendi', 'Necessitatibus ut vi', 'Et molestiae eos ma', 'Laborum deserunt qui', '2026-02-22 12:54:44', '2026-02-22 12:54:44');
INSERT INTO `ind_family_bg` (`id`, `inventory_id`, `relation_type`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES ('31', '10', 'father', 'EDUARDO NIRO', 'Test', 'FISHERMAN', '09480807188', 'Test', '2026-02-22 13:02:28', '2026-02-22 13:02:28');
INSERT INTO `ind_family_bg` (`id`, `inventory_id`, `relation_type`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES ('32', '10', 'mother', 'ADELAIDA GENITA', 'Test', 'Test', '09485507168', 'Test', '2026-02-22 13:02:28', '2026-02-22 13:02:28');
INSERT INTO `ind_family_bg` (`id`, `inventory_id`, `relation_type`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES ('33', '10', 'guardian', 'ADELAIDA NIRO', 'Test', 'Test', 'Test', 'Test', '2026-02-22 13:02:28', '2026-02-22 13:02:28');
INSERT INTO `ind_family_bg` (`id`, `inventory_id`, `relation_type`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES ('37', '12', 'father', 'ROBERT GACAYAN', 'Nulla expedita aliqu', 'FARMER', '09197592595', 'Magni ad harum dolor', '2026-02-27 08:33:00', '2026-02-27 08:33:00');
INSERT INTO `ind_family_bg` (`id`, `inventory_id`, `relation_type`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES ('38', '12', 'mother', 'ELIZABETH CALICA', 'Quos minus deleniti ', 'BRGY UTILITY', '09078036797', 'Illum mollitia earu', '2026-02-27 08:33:00', '2026-02-27 08:33:00');
INSERT INTO `ind_family_bg` (`id`, `inventory_id`, `relation_type`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES ('39', '12', 'guardian', 'DWAYNE FERDINAND APRECIO', 'Provident eligendi ', 'Rem itaque est qui e', 'Mollit ut nisi sit i', 'Nesciunt inventore ', '2026-02-27 08:33:01', '2026-02-27 08:33:01');


#
# TABLE STRUCTURE FOR: ind_siblings
#

DROP TABLE IF EXISTS `ind_siblings`;

CREATE TABLE `ind_siblings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `educational_attainment` varchar(150) DEFAULT NULL,
  `occupation` varchar(150) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ind_siblings` (`id`, `inventory_id`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES (22, 11, 'Jillian Fletcher', 'Aliquid qui dignissi', 'Esse recusandae Qu', 'Blanditiis recusanda', 'Quo qui officia et a', '2026-02-22 19:54:44', '2026-02-22 19:54:44');
INSERT INTO `ind_siblings` (`id`, `inventory_id`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES (26, 10, 'Test', 'Test', 'Test', 'Test', 'Test', '2026-02-22 20:02:28', '2026-02-22 20:02:28');
INSERT INTO `ind_siblings` (`id`, `inventory_id`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES (27, 10, 'Test', 'Test', 'Test', 'Test', 'Test', '2026-02-22 20:02:28', '2026-02-22 20:02:28');
INSERT INTO `ind_siblings` (`id`, `inventory_id`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES (28, 10, 'Test 3', 'Test 3', 'Test 3', 'Test 3', 'Test 3', '2026-02-22 20:02:28', '2026-02-22 20:02:28');
INSERT INTO `ind_siblings` (`id`, `inventory_id`, `name`, `educational_attainment`, `occupation`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES (30, 12, 'Yetta Lancaster', 'Voluptatem Tempora', 'Possimus facere sed', 'Exercitationem quis', 'Consequuntur et dist', '2026-02-27 15:33:00', '2026-02-27 15:33:00');


#
# TABLE STRUCTURE FOR: individual_inventory
#

DROP TABLE IF EXISTS `individual_inventory`;

CREATE TABLE `individual_inventory` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) unsigned NOT NULL,
  `form_category` enum('senior','elem','tvet_hmt','college','junior_high') NOT NULL,
  `academic_year` varchar(20) DEFAULT NULL COMMENT 'For All Forms',
  `status` enum('Active','Non-Active','Old-Student','New-Student','Transferee') DEFAULT 'Active',
  `semester` varchar(20) DEFAULT NULL,
  `qualification` varchar(50) DEFAULT NULL COMMENT 'For TVET/HMT form type',
  `course_id` int(11) DEFAULT NULL COMMENT 'For College',
  `year_level` enum('1st Year','2nd Year','3rd Year','4th Year','Grade 11','Grade 12','Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6','Grade 7','Grade 8','Grade 9','Grade 10') DEFAULT NULL COMMENT 'For College, SHS, HS and Elem',
  `strand` varchar(20) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `permanent_contact` varchar(50) DEFAULT NULL,
  `residential_address` varchar(255) DEFAULT NULL,
  `residential_contact` varchar(50) DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `living_with_parents` enum('Yes','No') DEFAULT NULL,
  `boarding_address` varchar(255) DEFAULT NULL,
  `landlord_name` varchar(100) DEFAULT NULL,
  `landlord_contact` varchar(50) DEFAULT NULL,
  `family_income` enum('3000Below','3000-6000','6000-9000','9000+') NOT NULL,
  `who_supports_family` varchar(255) DEFAULT NULL,
  `source_of_income` varchar(255) DEFAULT NULL,
  `is_scholar` enum('Yes','No') DEFAULT 'No',
  `scholarship_name` varchar(255) DEFAULT NULL,
  `is_working_student` enum('Yes','No') DEFAULT 'No',
  `working_place` varchar(255) DEFAULT NULL,
  `talents` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `sports` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `individual_inventory` (`id`, `student_id`, `form_category`, `academic_year`, `status`, `semester`, `qualification`, `course_id`, `year_level`, `strand`, `permanent_address`, `permanent_contact`, `residential_address`, `residential_contact`, `place_of_birth`, `date_of_birth`, `living_with_parents`, `boarding_address`, `landlord_name`, `landlord_contact`, `family_income`, `who_supports_family`, `source_of_income`, `is_scholar`, `scholarship_name`, `is_working_student`, `working_place`, `talents`, `skills`, `sports`, `created_at`, `updated_at`) VALUES ('9', '13', 'college', '', 'Active', '', '', NULL, '1st Year', '', 'Guinaburan Balaoan La  Union', '', 'Lingsat San Fernando La Union', '', 'Balaoan La Union', '2001-01-10', 'Yes', '', '', '', '', NULL, NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, '2026-02-11 15:14:00', '2026-02-22 04:36:29');
INSERT INTO `individual_inventory` (`id`, `student_id`, `form_category`, `academic_year`, `status`, `semester`, `qualification`, `course_id`, `year_level`, `strand`, `permanent_address`, `permanent_contact`, `residential_address`, `residential_contact`, `place_of_birth`, `date_of_birth`, `living_with_parents`, `boarding_address`, `landlord_name`, `landlord_contact`, `family_income`, `who_supports_family`, `source_of_income`, `is_scholar`, `scholarship_name`, `is_working_student`, `working_place`, `talents`, `skills`, `sports`, `created_at`, `updated_at`) VALUES ('10', '108', 'college', '2007-2008', 'New-Student', '1', NULL, 3, '3rd Year', NULL, 'MAGALLANES, LUNA LA UNION', NULL, 'Lingsat San Fernando La Union', NULL, 'MAGALLANES LUNA LA UNION', '2002-12-12', 'Yes', 'Test', 'Test', '09654646465', '3000Below', '', '', 'No', '', 'No', '', 'Test', 'Test', 'Test', '2026-02-22 11:04:56', '2026-02-22 13:02:28');
INSERT INTO `individual_inventory` (`id`, `student_id`, `form_category`, `academic_year`, `status`, `semester`, `qualification`, `course_id`, `year_level`, `strand`, `permanent_address`, `permanent_contact`, `residential_address`, `residential_contact`, `place_of_birth`, `date_of_birth`, `living_with_parents`, `boarding_address`, `landlord_name`, `landlord_contact`, `family_income`, `who_supports_family`, `source_of_income`, `is_scholar`, `scholarship_name`, `is_working_student`, `working_place`, `talents`, `skills`, `sports`, `created_at`, `updated_at`) VALUES ('11', '16', 'tvet_hmt', '1979-2980', 'Active', 'Assumenda qui facere', '', NULL, NULL, NULL, 'San Jose Sudipen La Union', NULL, 'Quo illo accusamus n', NULL, 'San Fernando City', '2005-09-22', 'No', 'Vel dolores et liber', 'Petra Ellis', 'Dolores illo non dol', '6000-9000', 'Sint dolorum aut fac', '582', 'No', 'Cole Barry', 'Yes', 'Minima sed hic dolor', 'Repellendus Nihil q', 'Consectetur debitis', 'Laborum illum sit ', '2026-02-22 12:52:22', '2026-02-22 12:54:44');
INSERT INTO `individual_inventory` (`id`, `student_id`, `form_category`, `academic_year`, `status`, `semester`, `qualification`, `course_id`, `year_level`, `strand`, `permanent_address`, `permanent_contact`, `residential_address`, `residential_contact`, `place_of_birth`, `date_of_birth`, `living_with_parents`, `boarding_address`, `landlord_name`, `landlord_contact`, `family_income`, `who_supports_family`, `source_of_income`, `is_scholar`, `scholarship_name`, `is_working_student`, `working_place`, `talents`, `skills`, `sports`, `created_at`, `updated_at`) VALUES ('12', '76', 'junior_high', '2016', 'New-Student', 'A impedit et pariat', NULL, NULL, 'Grade 1', '', 'PAO NORTE SAN FERNANDO LA UNION', NULL, 'Sit quia fugiat ali', NULL, 'NAGUILIAN, LA UNION', '2001-09-16', 'Yes', 'Consequatur veritat', 'Karleigh Church', 'Eaque quos ex in mag', '9000+', 'Sed sint veniam aut', '692', 'No', 'Herman Vargas', 'Yes', 'Commodi sequi repreh', 'Libero voluptatibus ', 'Ut aliquam qui qui e', 'Rerum blanditiis off', '2026-02-27 08:31:05', '2026-02-27 08:33:00');


#
# TABLE STRUCTURE FOR: junior_police_applications
#

DROP TABLE IF EXISTS `junior_police_applications`;

CREATE TABLE `junior_police_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `ethnicity` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `medical_condition` enum('Yes','No') DEFAULT NULL,
  `medical_condition_explain` text DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `year_level` varchar(20) DEFAULT NULL,
  `high_school_attended` varchar(150) DEFAULT NULL,
  `release_info_acknowledged` tinyint(1) DEFAULT NULL,
  `data_privacy_acknowledged` tinyint(1) DEFAULT NULL,
  `substance_abuse_status` enum('Never Used','Used Limited','Used Experimental') DEFAULT NULL,
  `religious_accommodation_acknowledged` tinyint(1) DEFAULT NULL,
  `conscientious_objector` enum('Not an Objector','Objector') DEFAULT NULL,
  `conscientious_explain` text DEFAULT NULL,
  `academic_status` enum('Eligible','Ineligible') DEFAULT NULL,
  `character_status` enum('Eligible','Ineligible') DEFAULT NULL,
  `tattoo_status` enum('Eligible','Ineligible') DEFAULT NULL,
  `medical_status` enum('Eligible','Ineligible') DEFAULT NULL,
  `abuse_eligibility` enum('Eligible','Ineligible') DEFAULT NULL,
  `age_eligibility` enum('Eligible','Ineligible') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `junior_police_applications` (`id`, `student_id`, `email`, `contact_number`, `permanent_address`, `zip_code`, `birthday`, `marital_status`, `weight`, `ethnicity`, `gender`, `religion`, `medical_condition`, `medical_condition_explain`, `course`, `year_level`, `high_school_attended`, `release_info_acknowledged`, `data_privacy_acknowledged`, `substance_abuse_status`, `religious_accommodation_acknowledged`, `conscientious_objector`, `conscientious_explain`, `academic_status`, `character_status`, `tattoo_status`, `medical_status`, `abuse_eligibility`, `age_eligibility`, `created_at`, `updated_at`) VALUES (1, 108, 'kira@gmail.com', '210', 'MAGALLANES, LUNA LA UNION', '38514', '2004-09-25', 'Single', 'Vitae ipsam qui nihi', 'Quis dolore fugiat', 'Male', 'ROMAN CATHOLIC', 'Yes', 'Incididunt velit ali', 'BSCRIM', '4th Year', 'Voluptas cumque qui', 1, 0, 'Used Experimental', 1, 'Not an Objector', 'Et temporibus et arc', 'Eligible', 'Ineligible', 'Ineligible', 'Ineligible', 'Eligible', 'Ineligible', '2025-12-01 15:09:05', '2026-02-22 08:58:44');


#
# TABLE STRUCTURE FOR: officers
#

DROP TABLE IF EXISTS `officers`;

CREATE TABLE `officers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `officer_type` enum('SBO','IB-CURSOR','V-SHARP','Classroom Officers') NOT NULL DEFAULT 'Classroom Officers' COMMENT 'Type of organization',
  `student_id` int(11) NOT NULL,
  `position` varchar(100) DEFAULT NULL COMMENT 'Position held (optional)',
  `academic_year` varchar(20) DEFAULT NULL COMMENT 'Academic year (e.g., 2025-2026)',
  `age` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `course_id` varchar(150) DEFAULT NULL,
  `has_prior_course` tinyint(1) DEFAULT 0 COMMENT '0=No,1=Yes',
  `prior_course_specify` varchar(255) DEFAULT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `cellular_number` varchar(50) DEFAULT NULL,
  `facebook_account` varchar(150) DEFAULT NULL,
  `mother_name` varchar(150) DEFAULT NULL,
  `mother_occupation` varchar(150) DEFAULT NULL,
  `father_name` varchar(150) DEFAULT NULL,
  `father_occupation` varchar(150) DEFAULT NULL,
  `guardian_name_relationship` varchar(255) DEFAULT NULL,
  `guardian_address` varchar(255) DEFAULT NULL,
  `emergency_contact_person` varchar(150) DEFAULT NULL,
  `emergency_telephone` varchar(50) DEFAULT NULL,
  `emergency_cellular` varchar(50) DEFAULT NULL,
  `hobbies_interests` text DEFAULT NULL,
  `past_time_why` text DEFAULT NULL,
  `suggestions` text DEFAULT NULL,
  `intend_contribute` text DEFAULT NULL,
  `reason_join` text DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `officers` (`id`, `officer_type`, `student_id`, `position`, `academic_year`, `age`, `date_of_birth`, `place_of_birth`, `course_id`, `has_prior_course`, `prior_course_specify`, `current_address`, `permanent_address`, `cellular_number`, `facebook_account`, `mother_name`, `mother_occupation`, `father_name`, `father_occupation`, `guardian_name_relationship`, `guardian_address`, `emergency_contact_person`, `emergency_telephone`, `emergency_cellular`, `hobbies_interests`, `past_time_why`, `suggestions`, `intend_contribute`, `reason_join`, `status`, `created_at`, `updated_at`) VALUES (1, 'SBO', 36, 'Doloremque qui minim', '1991', 53, '1980-01-31', 'Saepe qui praesentiu', '4', 1, 'Incidunt illum ull', 'Dolore eveniet est', 'Veritatis sint ipsam', '576', 'Excepteur voluptatem', 'Vladimir Hurley', 'Dicta rerum sed quia', 'Graham Hopkins', 'Est quaerat vero bea', 'Amaya Hensley', 'Culpa amet magnam v', 'Itaque mollitia sunt', '+1 (546) 434-5169', '309', 'Minus obcaecati non ', 'Blanditiis sint enim', 'Eu reiciendis Nam pa', 'Quis id voluptatem', 'Et error eos sit pr', 'Active', '2025-10-28 15:35:15', '2026-02-22 10:06:25');
INSERT INTO `officers` (`id`, `officer_type`, `student_id`, `position`, `academic_year`, `age`, `date_of_birth`, `place_of_birth`, `course_id`, `has_prior_course`, `prior_course_specify`, `current_address`, `permanent_address`, `cellular_number`, `facebook_account`, `mother_name`, `mother_occupation`, `father_name`, `father_occupation`, `guardian_name_relationship`, `guardian_address`, `emergency_contact_person`, `emergency_telephone`, `emergency_cellular`, `hobbies_interests`, `past_time_why`, `suggestions`, `intend_contribute`, `reason_join`, `status`, `created_at`, `updated_at`) VALUES (2, 'V-SHARP', 35, 'Sit doloremque omnis', '2003', 23, '2002-12-16', 'NATIVIDAD NAGUILIAN LA UNION', '5', 1, 'Eius ad laborum Mol', 'NAGYUBUYUBAN SAN FERNANDO LA UNION', 'Consequatur Est sed', '718', 'N/A', 'ELVIRA AGSAULIO', 'FARMER', 'JOSE AGSAULIO', 'FARMER', 'JULIUS AGSAULIO', 'Culpa do et cupidata', 'Laboriosam reiciend', '+1 (373) 227-6345', '993', 'Cupiditate aliquid r', 'Officia voluptates a', 'Dolor voluptatum aut', 'Nisi velit dolores v', 'Voluptatum consequat', 'Active', '2026-02-22 10:25:51', '2026-02-22 10:25:51');


#
# TABLE STRUCTURE FOR: program_form_structure
#

DROP TABLE IF EXISTS `program_form_structure`;

CREATE TABLE `program_form_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL COMMENT 'Scholarship program ID (references scholarship_programs.id)',
  `field_name` varchar(100) NOT NULL COMMENT 'Field name for form processing',
  `field_label` varchar(150) NOT NULL COMMENT 'Display label for the field',
  `field_type` enum('text','textarea','number','email','url','date','select','checkbox','radio') NOT NULL DEFAULT 'text',
  `field_options` text DEFAULT NULL COMMENT 'JSON string for select/radio/checkbox options',
  `required` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=required, 0=optional',
  `field_order` int(11) NOT NULL DEFAULT 0 COMMENT 'Order of display in form',
  `section` varchar(100) DEFAULT NULL COMMENT 'Form section grouping',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_program_id` (`program_id`),
  KEY `idx_field_order` (`field_order`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (1, 3, 'farm_size', 'Farm Size (hectares)', 'number', NULL, 1, 1, 'Agricultural Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (2, 3, 'crops_grown', 'Crops Grown', 'textarea', NULL, 1, 2, 'Agricultural Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (3, 3, 'farming_experience', 'Years of Farming Experience', 'number', NULL, 0, 3, 'Agricultural Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (4, 3, 'agricultural_training', 'Agricultural Training Received', 'textarea', NULL, 0, 4, 'Professional Development', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (5, 4, 'graduation_year', 'Year of Graduation', 'number', NULL, 1, 1, 'Alumni Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (6, 4, 'degree_earned', 'Degree Earned', 'text', NULL, 1, 2, 'Alumni Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (7, 4, 'current_occupation', 'Current Occupation', 'text', NULL, 0, 3, 'Professional Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (8, 4, 'alumni_contributions', 'Contributions to Alma Mater', 'textarea', NULL, 0, 4, 'Alumni Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (9, 5, 'gpa', 'Current GPA', 'number', NULL, 1, 1, 'Academic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (10, 5, 'semester_honors', 'Semester Honors Received', 'textarea', NULL, 1, 2, 'Academic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (11, 5, 'academic_achievements', 'Academic Achievements', 'textarea', NULL, 0, 3, 'Academic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (12, 5, 'leadership_roles', 'Leadership Roles', 'textarea', NULL, 0, 4, 'Leadership Experience', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (13, 6, 'family_income', 'Family Monthly Income', 'number', NULL, 1, 1, 'Financial Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (14, 6, 'family_size', 'Family Size', 'number', NULL, 1, 2, 'Financial Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (15, 6, 'financial_difficulties', 'Financial Difficulties', 'textarea', NULL, 0, 3, 'Financial Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (16, 6, 'other_sources', 'Other Financial Sources', 'textarea', NULL, 0, 4, 'Financial Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (17, 7, 'sibling_names', 'Sibling Names and Ages', 'textarea', NULL, 1, 1, 'Family Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (18, 7, 'sibling_schools', 'Siblings\' Schools', 'textarea', NULL, 1, 2, 'Family Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (19, 7, 'family_support', 'Family Support System', 'textarea', NULL, 0, 3, 'Family Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (20, 7, 'educational_goals', 'Educational Goals', 'textarea', NULL, 0, 4, 'Academic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (21, 8, 'fishing_experience', 'Years of Fishing Experience', 'number', NULL, 1, 1, 'Professional Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (22, 8, 'fishing_area', 'Fishing Area/Location', 'text', NULL, 1, 2, 'Professional Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (23, 8, 'fishing_equipment', 'Fishing Equipment Owned', 'textarea', NULL, 0, 3, 'Professional Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (24, 8, 'marine_conservation', 'Marine Conservation Activities', 'textarea', NULL, 0, 4, 'Environmental Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (25, 9, 'residence_area', 'Residence Area', 'text', NULL, 1, 1, 'Geographic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (26, 9, 'accessibility_challenges', 'Accessibility Challenges', 'textarea', NULL, 1, 2, 'Geographic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (27, 9, 'community_involvement', 'Community Involvement', 'textarea', NULL, 0, 3, 'Community Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (28, 9, 'development_goals', 'Community Development Goals', 'textarea', NULL, 0, 4, 'Community Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (29, 10, 'sport', 'Sport/Event', 'text', NULL, 1, 1, 'Athletic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (30, 10, 'athletic_achievements', 'Athletic Achievements', 'textarea', NULL, 1, 2, 'Athletic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (31, 10, 'training_schedule', 'Training Schedule', 'textarea', NULL, 0, 3, 'Athletic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (32, 10, 'coach_recommendation', 'Coach Recommendation', 'textarea', NULL, 0, 4, 'Athletic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (33, 11, 'academic_excellence', 'Academic Excellence Record', 'textarea', NULL, 1, 1, 'Academic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (34, 11, 'community_service', 'Community Service Activities', 'textarea', NULL, 1, 2, 'Community Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (35, 11, 'leadership_experience', 'Leadership Experience', 'textarea', NULL, 0, 3, 'Leadership Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (36, 11, 'future_plans', 'Future Career Plans', 'textarea', NULL, 0, 4, 'Career Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (37, 12, 'police_affiliation', 'Police Affiliation', 'text', NULL, 1, 1, 'Police Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (38, 12, 'community_service_hours', 'Community Service Hours', 'number', NULL, 1, 2, 'Community Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (39, 12, 'leadership_activities', 'Leadership Activities', 'textarea', NULL, 0, 3, 'Leadership Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (40, 12, 'future_career_goals', 'Future Career Goals', 'textarea', NULL, 0, 4, 'Career Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (41, 13, 'board_connection', 'Board Member Connection', 'text', NULL, 1, 1, 'Board Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (42, 13, 'recommendation_letter', 'Recommendation Letter', 'text', NULL, 1, 2, 'Documentation', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (43, 13, 'academic_merit', 'Academic Merit', 'textarea', NULL, 0, 3, 'Academic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (44, 13, 'community_involvement', 'Community Involvement', 'textarea', NULL, 0, 4, 'Community Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (45, 14, 'police_office_affiliation', 'Police Office Affiliation', 'text', NULL, 1, 1, 'Police Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (46, 14, 'partnership_details', 'Partnership Details', 'textarea', NULL, 1, 2, 'Partnership Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (47, 14, 'community_service_record', 'Community Service Record', 'textarea', NULL, 0, 3, 'Community Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (48, 14, 'academic_standing', 'Academic Standing', 'textarea', NULL, 0, 4, 'Academic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (49, 15, 'hospitality_experience', 'Hospitality Experience', 'textarea', NULL, 1, 1, 'Professional Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (50, 15, 'industry_certifications', 'Industry Certifications', 'textarea', NULL, 1, 2, 'Professional Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (51, 15, 'practical_training', 'Practical Training Experience', 'textarea', NULL, 0, 3, 'Professional Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (52, 15, 'career_goals', 'Career Goals in Hospitality', 'textarea', NULL, 0, 4, 'Career Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (53, 16, 'tribal_affiliation', 'Tribal Affiliation', 'text', NULL, 1, 1, 'Cultural Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (54, 16, 'cultural_practices', 'Cultural Practices', 'textarea', NULL, 1, 2, 'Cultural Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (55, 16, 'community_leadership', 'Community Leadership', 'textarea', NULL, 0, 3, 'Leadership Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (56, 16, 'cultural_preservation', 'Cultural Preservation Efforts', 'textarea', NULL, 0, 4, 'Cultural Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (57, 17, 'employee_relation', 'Employee Relationship', 'text', NULL, 1, 1, 'Employee Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (58, 17, 'employee_department', 'Employee Department', 'text', NULL, 1, 2, 'Employee Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (59, 17, 'years_of_service', 'Years of Service', 'number', NULL, 0, 3, 'Employee Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (60, 17, 'performance_rating', 'Performance Rating', 'text', NULL, 0, 4, 'Employee Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (61, 18, 'partnership_organization', 'Partnership Organization', 'text', NULL, 1, 1, 'Partnership Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (62, 18, 'partnership_terms', 'Partnership Terms', 'textarea', NULL, 1, 2, 'Partnership Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (63, 18, 'selection_criteria', 'Selection Criteria', 'textarea', NULL, 0, 3, 'Selection Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (64, 18, 'benefits_package', 'Benefits Package', 'textarea', NULL, 0, 4, 'Benefits Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (65, 19, 'artistic_discipline', 'Artistic Discipline', 'text', NULL, 1, 1, 'Artistic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (66, 19, 'artistic_achievements', 'Artistic Achievements', 'textarea', NULL, 1, 2, 'Artistic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (67, 19, 'portfolio_description', 'Portfolio Description', 'textarea', NULL, 0, 3, 'Artistic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');
INSERT INTO `program_form_structure` (`id`, `program_id`, `field_name`, `field_label`, `field_type`, `field_options`, `required`, `field_order`, `section`, `created_at`, `updated_at`) VALUES (68, 19, 'future_artistic_goals', 'Future Artistic Goals', 'textarea', NULL, 0, 4, 'Artistic Information', '2025-10-05 08:34:59', '2025-10-05 08:34:59');


#
# TABLE STRUCTURE FOR: sbo_applicant_siblings
#

DROP TABLE IF EXISTS `sbo_applicant_siblings`;

CREATE TABLE `sbo_applicant_siblings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `sibling_name` varchar(255) DEFAULT NULL,
  `sibling_age` int(11) DEFAULT NULL,
  `sibling_year_course` varchar(100) DEFAULT NULL,
  `sibling_school_workplace` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`),
  CONSTRAINT `sbo_applicant_siblings_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `sbo_applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sbo_applicant_siblings` (`id`, `application_id`, `sibling_name`, `sibling_age`, `sibling_year_course`, `sibling_school_workplace`) VALUES (10, 2, 'Riley Knight', 30, '1987', 'Et non vel commodo m');
INSERT INTO `sbo_applicant_siblings` (`id`, `application_id`, `sibling_name`, `sibling_age`, `sibling_year_course`, `sibling_school_workplace`) VALUES (11, 2, 'Leo Acevedo', 79, '1972', 'Ea est culpa magni ');
INSERT INTO `sbo_applicant_siblings` (`id`, `application_id`, `sibling_name`, `sibling_age`, `sibling_year_course`, `sibling_school_workplace`) VALUES (12, 2, 'Chanda Fry', 97, '1986', 'Aut incididunt cum t');


#
# TABLE STRUCTURE FOR: sbo_applications
#

DROP TABLE IF EXISTS `sbo_applications`;

CREATE TABLE `sbo_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(20) DEFAULT '2025-2026',
  `date_of_filing` date DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_year` varchar(50) DEFAULT NULL,
  `position_applied` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `cellphone_number` varchar(20) DEFAULT NULL,
  `landline_number` varchar(20) DEFAULT NULL,
  `email_address` varchar(150) DEFAULT NULL,
  `facebook_account` varchar(150) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `father_education` varchar(100) DEFAULT NULL,
  `father_contact_no` varchar(20) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `mother_education` varchar(100) DEFAULT NULL,
  `mother_contact_no` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sbo_applications` (`id`, `academic_year`, `date_of_filing`, `student_id`, `course_year`, `position_applied`, `address`, `gender`, `age`, `birthdate`, `birth_place`, `religion`, `nationality`, `cellphone_number`, `landline_number`, `email_address`, `facebook_account`, `father_name`, `father_occupation`, `father_education`, `father_contact_no`, `mother_name`, `mother_occupation`, `mother_education`, `mother_contact_no`, `created_at`) VALUES (2, '2007', '2016-10-03', 84, 'BSCRIM 4th Year', 'Omnis eos anim praes', 'BACSIL, SAN FERNANDO LA UNION', 'Male', 86, '2002-08-23', 'BACSIL, SAN FERNANDO LA UNION', 'ROMAN CATHOLIC', 'FILIPINO', '+1 (365) 878-2761', '67676767', 'kai2@gmail.com', 'CARLO JUCUTAN', 'CLETO B. JUCUTAN', 'RETIRED POLICE', 'Suscipit eaque adipi', 'Laudantium officia', 'FERLD LANGOS VICIO', 'HOUSE WIFE', 'Irure exercitation s', 'Omnis voluptas totam', '2026-02-22 09:19:57');


#
# TABLE STRUCTURE FOR: scholarship_edu_bg
#

DROP TABLE IF EXISTS `scholarship_edu_bg`;

CREATE TABLE `scholarship_edu_bg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scholarship_id` int(11) NOT NULL COMMENT 'Reference to scholarships table',
  `education_level` enum('Pre-School','Elementary','High-School','College') NOT NULL,
  `school_name` varchar(200) DEFAULT NULL COMMENT 'Name of the school attended',
  `year_graduated` varchar(10) DEFAULT NULL COMMENT 'Year of graduation',
  `honors_received` varchar(200) DEFAULT NULL COMMENT 'Honors or awards received',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `scholarship_id` (`scholarship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Education background for scholarship applications';

INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (223, 19, 'Pre-School', 'Elijah Stanton', '1988', 'Saepe in ad inventor', '2026-02-27 09:12:56', '2026-02-27 09:12:56');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (224, 19, 'Elementary', 'Melyssa Vaughn', '1972', 'Minus voluptas moles', '2026-02-27 09:12:56', '2026-02-27 09:12:56');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (225, 19, 'High-School', '', '', '', '2026-02-27 09:12:56', '2026-02-27 09:12:56');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (226, 19, 'College', 'Germane Wynn', '1992', 'Ipsum dolorem do lab', '2026-02-27 09:12:56', '2026-02-27 09:12:56');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (227, 18, 'Pre-School', 'Astra Gordon', '2008', 'Quis enim ut quam at', '2026-02-27 09:20:07', '2026-02-27 09:20:07');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (228, 18, 'Elementary', 'Alec Snider', '1993', 'Consequatur Officia', '2026-02-27 09:20:07', '2026-02-27 09:20:07');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (229, 18, 'High-School', 'Test', '31231', 'Test', '2026-02-27 09:20:07', '2026-02-27 09:20:07');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (230, 18, 'College', 'Jamal Clayton', '2006', 'Suscipit sunt ad per', '2026-02-27 09:20:07', '2026-02-27 09:20:07');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (231, 20, 'Pre-School', 'Abraham Pate', '1986', 'Eiusmod dolore sunt ', '2026-02-27 09:20:41', '2026-02-27 09:20:41');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (232, 20, 'Elementary', 'Brandon Ware', '1976', 'Lorem dolor deserunt', '2026-02-27 09:20:41', '2026-02-27 09:20:41');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (233, 20, 'High-School', 'Maggie Deleon', '1986', 'Dolor delectus sit ', '2026-02-27 09:20:41', '2026-02-27 09:20:41');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (234, 20, 'College', 'Harrison Santana', '1973', 'Sint sunt aut culpa', '2026-02-27 09:20:41', '2026-02-27 09:20:41');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (235, 21, 'Pre-School', 'Kelsie Keller', '1989', 'Maiores dolor quaera', '2026-02-27 09:21:10', '2026-02-27 09:21:10');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (236, 21, 'Elementary', 'Finn Gomez', '2009', 'Facere laborum odit ', '2026-02-27 09:21:10', '2026-02-27 09:21:10');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (237, 21, 'High-School', 'Jermaine Fox', '2016', 'Mollitia sunt asperi', '2026-02-27 09:21:10', '2026-02-27 09:21:10');
INSERT INTO `scholarship_edu_bg` (`id`, `scholarship_id`, `education_level`, `school_name`, `year_graduated`, `honors_received`, `created_at`, `updated_at`) VALUES (238, 21, 'College', 'Zelenia Curry', '1972', 'Asperiores labore si', '2026-02-27 09:21:10', '2026-02-27 09:21:10');


#
# TABLE STRUCTURE FOR: scholarship_programs
#

DROP TABLE IF EXISTS `scholarship_programs`;

CREATE TABLE `scholarship_programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scholarship_name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `source` enum('government','sjbcnl') NOT NULL COMMENT 'Rview for the meantime',
  `type` int(11) DEFAULT NULL COMMENT 'Rview for the meantime',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (3, 'Farmers Scholarship Program', 'Farmers Scholarship Program', 'sjbcnl', 1, '2025-09-18 13:37:16', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (4, 'Big Brother/Sister Scholarship Partnership with PNP ALUMNI', 'Big Brother/Sister Scholarship Partnership with PNP ALUMNI', 'sjbcnl', 6, '2025-09-18 13:37:27', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (5, 'President\'s List Scholarship Program', 'President\'s List Scholarship Program', 'sjbcnl', 2, '2025-09-18 13:37:42', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (6, 'Education Service Contracting', 'Education Service Contracting', 'government', 6, '2025-09-18 13:37:55', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (7, 'Athletic Scholarship Program', 'Athletic Scholarship Program', 'sjbcnl', 4, '2025-09-18 13:38:05', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (8, 'Fisherfolks Scholarship Program', 'Fisherfolks Scholarship Program', 'sjbcnl', 6, '2025-09-18 13:47:21', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (9, 'ESC Program CHED', 'Tulong Dunong Program', 'government', 6, '2025-09-18 13:47:31', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (11, 'Hon. Rodolfo M. Abat -- College President\'s Scholar', 'Hon. Rodolfo M. Abat -- College President\'s Scholarship Program For Senior High School', 'sjbcnl', 5, '2025-09-18 13:47:54', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (12, 'Junior Police, Kabataan Para Sa Pamayanan Scholars', 'Junior Police, Kabataan Para Sa Pamayanan Scholarship Program', 'sjbcnl', 6, '2025-09-18 13:48:03', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (14, 'Indigenous Peoples Scholarship Program', 'Indigenous Peoples Scholarship Program', 'sjbcnl', 5, '2025-09-18 13:48:32', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (15, 'BSFHMP', 'Bosconians\' Society of Future Hospitality Management Practitioners (BSFHMP) Scholarship Program', 'sjbcnl', 6, '2025-09-18 13:48:44', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (17, 'Employees Dependent Scholarship Program', 'Employees Dependent Scholarship Program', 'sjbcnl', 4, '2025-09-18 13:49:01', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (18, 'RRSU (Iskular para ti Kanayunan)', 'The Regional Recruitment and Selection Unit  (Iskular  para ti Kanayunan)', 'sjbcnl', 6, '2025-09-18 13:49:22', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (19, 'Culture and Arts Scholarship', 'Culture and Arts Scholarship', 'sjbcnl', 5, '2025-09-18 13:49:31', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (21, 'Senior High Voucher', 'BASIC ED', 'government', NULL, '2025-12-04 13:39:49', NULL);
INSERT INTO `scholarship_programs` (`id`, `scholarship_name`, `description`, `source`, `type`, `created_at`, `updated_at`) VALUES (22, 'Financial Assistance Scholarship', 'Financial Assistance Scholarship', 'sjbcnl', NULL, '2025-12-04 13:39:49', NULL);


#
# TABLE STRUCTURE FOR: scholarship_siblings
#

DROP TABLE IF EXISTS `scholarship_siblings`;

CREATE TABLE `scholarship_siblings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scholarship_id` int(11) NOT NULL COMMENT 'Reference to scholarships table',
  `sibling_name` varchar(150) NOT NULL COMMENT 'Name of the sibling',
  `sibling_age` int(3) DEFAULT NULL COMMENT 'Age of the sibling',
  `sibling_course` varchar(100) DEFAULT NULL COMMENT 'Course or year level of the sibling',
  `sibling_school` varchar(200) DEFAULT NULL COMMENT 'School where sibling is enrolled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `scholarship_id` (`scholarship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Siblings information for scholarship applications';

INSERT INTO `scholarship_siblings` (`id`, `scholarship_id`, `sibling_name`, `sibling_age`, `sibling_course`, `sibling_school`, `created_at`, `updated_at`) VALUES (231, 19, 'Carl Haney', 57, 'Consequatur Pariatu', 'Ipsa culpa sit et', '2026-02-27 09:12:56', '2026-02-27 09:12:56');
INSERT INTO `scholarship_siblings` (`id`, `scholarship_id`, `sibling_name`, `sibling_age`, `sibling_course`, `sibling_school`, `created_at`, `updated_at`) VALUES (232, 18, 'Kathleen Carrillo', 44, 'Voluptatum doloribus', 'Enim ullam doloribus', '2026-02-27 09:20:07', '2026-02-27 09:20:07');
INSERT INTO `scholarship_siblings` (`id`, `scholarship_id`, `sibling_name`, `sibling_age`, `sibling_course`, `sibling_school`, `created_at`, `updated_at`) VALUES (233, 20, 'Andrew Norton', 40, 'Lorem adipisci eiusm', 'Laudantium voluptat', '2026-02-27 09:20:41', '2026-02-27 09:20:41');
INSERT INTO `scholarship_siblings` (`id`, `scholarship_id`, `sibling_name`, `sibling_age`, `sibling_course`, `sibling_school`, `created_at`, `updated_at`) VALUES (234, 21, 'Malachi Cain', 31, 'Quam amet veritatis', 'Optio omnis aut qui', '2026-02-27 09:21:10', '2026-02-27 09:21:10');


#
# TABLE STRUCTURE FOR: scholarships
#

DROP TABLE IF EXISTS `scholarships`;

CREATE TABLE `scholarships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL COMMENT 'Student ID from students table',
  `course_id` int(11) DEFAULT NULL,
  `scholarship_id` mediumint(9) DEFAULT NULL COMMENT 'Data from the scholars table',
  `application_type` enum('New','Renewal') NOT NULL DEFAULT 'New' COMMENT 'Type of application - New or Renewal',
  `semester` int(11) NOT NULL COMMENT '1: first sem, 2: sec sem (Semester and Academic Year of Entry)',
  `academic_year` varchar(50) DEFAULT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `birth_date` varchar(50) NOT NULL,
  `birth_place` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL COMMENT 'Male and Female',
  `religion` varchar(50) NOT NULL,
  `father_name` varchar(150) NOT NULL,
  `father_address` varchar(50) NOT NULL,
  `father_occupation` varchar(50) NOT NULL,
  `father_highest_education` varchar(50) NOT NULL,
  `mother_name` varchar(150) NOT NULL,
  `mother_address` varchar(50) NOT NULL,
  `mother_occupation` varchar(50) NOT NULL,
  `mother_highest_education` varchar(50) NOT NULL,
  `talent_description` varchar(200) DEFAULT NULL,
  `application_status` enum('Pending','Under Review','Approved','Rejected','On Hold') DEFAULT 'Pending',
  `approval_date` date DEFAULT NULL COMMENT 'Date when application was approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `application_status` (`application_status`),
  KEY `application_type` (`application_type`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Scholarship applications table with comprehensive form data';

INSERT INTO `scholarships` (`id`, `student_id`, `course_id`, `scholarship_id`, `application_type`, `semester`, `academic_year`, `contact_no`, `address`, `email`, `facebook`, `birth_date`, `birth_place`, `gender`, `religion`, `father_name`, `father_address`, `father_occupation`, `father_highest_education`, `mother_name`, `mother_address`, `mother_occupation`, `mother_highest_education`, `talent_description`, `application_status`, `approval_date`, `created_at`, `updated_at`) VALUES (18, 92, 4, 19, 'New', 2, '2034-2035', 2147483647, 'SAGAYAD SAN FERNANDO LA UNION', 'kirara@gmail.com', 'LESTER DALUMPINES LUBRICA', '1999-03-11', 'SAN FERNANDO LA UNION', 'Male', 'ROMAN CATHOLIC', 'REGINO LUBRICA', 'Ipsa dolore ratione', 'PGLU DRIVER', 'Laboris dolorem repe', 'OFELIA LUBRICA', 'Voluptas voluptatem', 'GOVERNMENT EMPLOYEE', 'Voluptas tempore el', 'Ex ad aut rerum sint', 'Pending', NULL, '2026-02-26 16:51:35', '2026-02-27 08:07:11');
INSERT INTO `scholarships` (`id`, `student_id`, `course_id`, `scholarship_id`, `application_type`, `semester`, `academic_year`, `contact_no`, `address`, `email`, `facebook`, `birth_date`, `birth_place`, `gender`, `religion`, `father_name`, `father_address`, `father_occupation`, `father_highest_education`, `mother_name`, `mother_address`, `mother_occupation`, `mother_highest_education`, `talent_description`, `application_status`, `approval_date`, `created_at`, `updated_at`) VALUES (19, 17, 2, 9, 'New', 1, '2027-2028', 2147483647, 'Lingsat San Fernando La Union', 'kirara@gmail.com', 'John Poe', '2004-03-09', 'SAN FERNANDO LA UNION', 'Male', 'ROMAN CATHOLIC', 'REGINO LUBRICA', 'Corrupti assumenda', 'PGLU DRIVER', 'Adipisci voluptas bl', 'CAROLINA DIGA', 'Omnis vel adipisicin', 'GOVERNMENT EMPLOYEE', 'Libero at odio est l', 'Officia molestias si', 'Pending', NULL, '2026-02-27 09:12:56', '2026-02-27 09:12:56');
INSERT INTO `scholarships` (`id`, `student_id`, `course_id`, `scholarship_id`, `application_type`, `semester`, `academic_year`, `contact_no`, `address`, `email`, `facebook`, `birth_date`, `birth_place`, `gender`, `religion`, `father_name`, `father_address`, `father_occupation`, `father_highest_education`, `mother_name`, `mother_address`, `mother_occupation`, `mother_highest_education`, `talent_description`, `application_status`, `approval_date`, `created_at`, `updated_at`) VALUES (20, 20, 2, 19, 'New', 2, '2021-2022', 2147483647, 'Sitio Galting Casilagan Naguilian La Union', 'kra@gmail.com', 'dasdasda', '2005-03-04', 'ddasdasd', 'Male', 'LUTHERAN', 'SIMEON DIGA JR.', 'Blanditiis qui nobis', 'PGLU DRIVER', 'Ipsum qui corporis a', 'NAYSAN BUGTONG', 'Labore adipisci corp', 'SELLER', 'Sunt et quia rerum', 'Ipsum consequatur T', 'Pending', NULL, '2026-02-27 09:20:41', '2026-02-27 09:20:41');
INSERT INTO `scholarships` (`id`, `student_id`, `course_id`, `scholarship_id`, `application_type`, `semester`, `academic_year`, `contact_no`, `address`, `email`, `facebook`, `birth_date`, `birth_place`, `gender`, `religion`, `father_name`, `father_address`, `father_occupation`, `father_highest_education`, `mother_name`, `mother_address`, `mother_occupation`, `mother_highest_education`, `talent_description`, `application_status`, `approval_date`, `created_at`, `updated_at`) VALUES (21, 62, 4, 9, 'New', 2, '2023-2024', 2147483647, 'SAGAYAD SAN FERNANDO LA UNION', 'kirara@gmail.com', 'NONE', '2003-11-13', 'SAN FERNANDO LA UNION', 'Male', 'ROMAN CATHOLIC', 'EDDIE CARINO', 'Eaque consectetur m', 'FARMER', 'Eveniet sed sint n', 'VIRGIE CARINO', 'Iusto vel veritatis', 'HOUSEKEEPING', 'Numquam reprehenderi', 'Ea dolor ullam illum', 'Rejected', NULL, '2026-02-27 09:21:10', '2026-03-01 13:45:46');


#
# TABLE STRUCTURE FOR: sports
#

DROP TABLE IF EXISTS `sports`;

CREATE TABLE `sports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `sport_list_id` int(11) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `team_name` varchar(100) DEFAULT NULL,
  `achievements` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Active','Inactive','Graduated') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `sports_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# TABLE STRUCTURE FOR: sports_events
#

DROP TABLE IF EXISTS `sports_events`;

CREATE TABLE `sports_events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `status` enum('Registered','Confirmed','Disqualified','Withdrawn','Active','Eliminated','Champion') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sports_events` (`id`, `student_id`, `event_name`, `status`, `created_at`, `updated_at`) VALUES (1, 3, 'Test', 'Registered', '2025-11-05 04:19:41', '2025-11-05 04:19:41');
INSERT INTO `sports_events` (`id`, `student_id`, `event_name`, `status`, `created_at`, `updated_at`) VALUES (2, 15, 'alto', 'Registered', '2026-02-12 02:03:58', '2026-02-12 02:03:58');
INSERT INTO `sports_events` (`id`, `student_id`, `event_name`, `status`, `created_at`, `updated_at`) VALUES (3, 15, 'ALTO', 'Registered', '2026-02-12 02:11:38', '2026-02-12 02:11:38');
INSERT INTO `sports_events` (`id`, `student_id`, `event_name`, `status`, `created_at`, `updated_at`) VALUES (4, 62, 'Test', 'Withdrawn', '2026-02-22 02:39:28', '2026-02-22 02:39:28');


#
# TABLE STRUCTURE FOR: sports_list
#

DROP TABLE IF EXISTS `sports_list`;

CREATE TABLE `sports_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sports_list` (`id`, `name`, `description`, `created_at`) VALUES (1, 'Basketball', '', '2025-11-04 12:46:52');
INSERT INTO `sports_list` (`id`, `name`, `description`, `created_at`) VALUES (2, 'Volleyball', '', '2026-02-12 07:41:42');
INSERT INTO `sports_list` (`id`, `name`, `description`, `created_at`) VALUES (3, 'Sepak', '', '2026-02-12 07:41:48');
INSERT INTO `sports_list` (`id`, `name`, `description`, `created_at`) VALUES (4, 'Badminton', '', '2026-02-12 07:41:57');
INSERT INTO `sports_list` (`id`, `name`, `description`, `created_at`) VALUES (5, 'Chess', '', '2026-02-12 07:42:04');
INSERT INTO `sports_list` (`id`, `name`, `description`, `created_at`) VALUES (6, 'Scrabble', '', '2026-02-12 07:42:10');
INSERT INTO `sports_list` (`id`, `name`, `description`, `created_at`) VALUES (7, 'Atletics', '', '2026-02-12 07:42:15');


#
# TABLE STRUCTURE FOR: student_sport_profile
#

DROP TABLE IF EXISTS `student_sport_profile`;

CREATE TABLE `student_sport_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) NOT NULL,
  `course_year` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `facebook_account` varchar(255) DEFAULT NULL,
  `gmail_account` varchar(255) DEFAULT NULL,
  `sport_id` int(11) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `present_address` varchar(255) DEFAULT NULL,
  `cellphone_number` varchar(50) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mother_contact` varchar(50) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `father_contact` varchar(50) DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_contact` varchar(50) DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `emergency_contact_number` varchar(50) DEFAULT NULL,
  `career_expectation` text DEFAULT NULL,
  `greatest_achievement` text DEFAULT NULL,
  `stress_management` text DEFAULT NULL,
  `organization_asset` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `student_sport_profile` (`id`, `student_id`, `course_year`, `age`, `dob`, `place_of_birth`, `facebook_account`, `gmail_account`, `sport_id`, `position`, `current_address`, `present_address`, `cellphone_number`, `mother_name`, `mother_contact`, `father_name`, `father_contact`, `guardian_name`, `guardian_contact`, `emergency_contact`, `emergency_contact_number`, `career_expectation`, `greatest_achievement`, `stress_management`, `organization_asset`, `created_at`) VALUES (2, '2022-01517', 'BSCS 4th Year', 0, '2001-01-10', 'Balaoan La Union', 'marquezjonnamae 028@gmail.com', '', 0, '', 'Guinaburan Balaoan La  Union', 'Lingsat San Fernando La Union', '09280590201', 'Josephine N. Marquez', '09290590201', 'Metriano V. Marquez', '09156661332', 'Josephine N. Marquez', '', 'Josephine N. Marquez', '', '', '', '', '', '2026-02-12 14:44:24');
INSERT INTO `student_sport_profile` (`id`, `student_id`, `course_year`, `age`, `dob`, `place_of_birth`, `facebook_account`, `gmail_account`, `sport_id`, `position`, `current_address`, `present_address`, `cellphone_number`, `mother_name`, `mother_contact`, `father_name`, `father_contact`, `guardian_name`, `guardian_contact`, `emergency_contact`, `emergency_contact_number`, `career_expectation`, `greatest_achievement`, `stress_management`, `organization_asset`, `created_at`) VALUES (3, '2023-01893', 'BSCS 4th Year', NULL, '2002-06-30', 'Ezperanza, Dilasag, Aurora', 'jonajaide0630@gmail.com', '', 0, '', 'Purok 5, Suyo, Bagulin, La Union', 'Purok 5, Suyo, Bagulin, La Union', '', 'Jonafee Paclibary Layco', '09156661332', '', 'N/A', '', '', '', '', '', '', '', '', '2026-02-12 14:46:02');
INSERT INTO `student_sport_profile` (`id`, `student_id`, `course_year`, `age`, `dob`, `place_of_birth`, `facebook_account`, `gmail_account`, `sport_id`, `position`, `current_address`, `present_address`, `cellphone_number`, `mother_name`, `mother_contact`, `father_name`, `father_contact`, `guardian_name`, `guardian_contact`, `emergency_contact`, `emergency_contact_number`, `career_expectation`, `greatest_achievement`, `stress_management`, `organization_asset`, `created_at`) VALUES (4, '2022-01596', 'BSCS 4th Year', NULL, '2002-06-30', 'Ezperanza, Dilasag, Aurora', 'jonajaide0630@gmail.com', '', 0, '', 'Purok 5, Suyo, Bagulin, La Union', 'Purok 5, Suyo, Bagulin, La Union', '09156661332', 'Jonafee Paclibary Layco', '09156661332', 'Ruben S. Ayawan', 'N/A', 'Jonafee Ayawan', '', 'Jona Jaide Layco Ayawan', '', '', '', '', '', '2026-02-12 14:46:02');
INSERT INTO `student_sport_profile` (`id`, `student_id`, `course_year`, `age`, `dob`, `place_of_birth`, `facebook_account`, `gmail_account`, `sport_id`, `position`, `current_address`, `present_address`, `cellphone_number`, `mother_name`, `mother_contact`, `father_name`, `father_contact`, `guardian_name`, `guardian_contact`, `emergency_contact`, `emergency_contact_number`, `career_expectation`, `greatest_achievement`, `stress_management`, `organization_asset`, `created_at`) VALUES (5, '2023-00001', 'BSCS 3rd Year', NULL, '2005-03-12', '', '', '', 3, '', 'Kimmallogong Sur Naguilian La Union', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2026-02-12 14:50:07');
INSERT INTO `student_sport_profile` (`id`, `student_id`, `course_year`, `age`, `dob`, `place_of_birth`, `facebook_account`, `gmail_account`, `sport_id`, `position`, `current_address`, `present_address`, `cellphone_number`, `mother_name`, `mother_contact`, `father_name`, `father_contact`, `guardian_name`, `guardian_contact`, `emergency_contact`, `emergency_contact_number`, `career_expectation`, `greatest_achievement`, `stress_management`, `organization_asset`, `created_at`) VALUES (6, '2022-01529', 'BSCRIM 4th Year', 85, '2003-08-16', 'BANGAR LA UNION', 'JOHN MIKE MONIS', 'byfyxul@mailinator.com', 5, 'Laboris reiciendis s', 'LETTAC SUR SANTOL LA UNION', 'Quas recusandae Ali', '+1 (235) 384-8117', 'VILMA ORILLO RAGMAC', '09707778059', 'MICHAEL M MONIS', '09464561728', 'VILMA MONIS', 'Ex amet consequuntu', 'Lorem vero aut et el', '489', 'Voluptatem At quae ', 'Nihil at eu voluptas', 'Veniam dolor eum ma', 'Ea exercitationem ve', '2026-02-27 15:54:05');


#
# TABLE STRUCTURE FOR: student_violations
#

DROP TABLE IF EXISTS `student_violations`;

CREATE TABLE `student_violations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `violation_id` int(11) NOT NULL,
  `duty_in_charge` varchar(150) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `student_violations` (`id`, `student_id`, `violation_id`, `duty_in_charge`, `remarks`, `document_path`, `created_at`, `updated_at`) VALUES (9, 33, 13, 'maam pam corpuz', '', NULL, '2026-02-12 07:30:21', '2026-02-12 14:30:21');


#
# TABLE STRUCTURE FOR: students
#

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(50) NOT NULL COMMENT 'Also StudentId',
  `registration_date` date DEFAULT NULL,
  `year_level` enum('1st Year','2nd Year','3rd Year','4th Year','Grade 11','Grade 12','Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6','Grade 7','Grade 8','Grade 9','Grade 10') DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `extension_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `civil_status` enum('Single','Married') NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `resedential_address` varchar(50) DEFAULT NULL,
  `boarding_house_address` varchar(100) NOT NULL,
  `email_fb_account` varchar(50) NOT NULL,
  `father_name` varchar(50) DEFAULT NULL,
  `father_occupation` varchar(50) DEFAULT NULL,
  `father_contact` varchar(50) DEFAULT NULL,
  `mother_name` varchar(50) DEFAULT NULL,
  `mother_occupation` varchar(50) DEFAULT NULL,
  `mother_contact` varchar(50) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL COMMENT 'NULL IF FORM TYPE = TVET OR BASIC EDU',
  `section` varchar(20) DEFAULT NULL,
  `school_year` varchar(20) NOT NULL,
  `guardian_name` varchar(150) DEFAULT NULL,
  `guardian_address` varchar(50) NOT NULL,
  `guardian_relationship` varchar(50) DEFAULT NULL,
  `status` enum('Enrolled','Undergraduate','Dropped','Alumni','AWOL','LOA','Dismissed','Expelled') NOT NULL DEFAULT 'Enrolled' COMMENT 'Academic status of the student',
  `enrolled_status` enum('Regular','Irregular') DEFAULT NULL COMMENT 'Null if not college level',
  `education_level` enum('senior_high','junior_high','elementary','tvet_hmt','college') DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (13, '2022-01517', '2022-10-08', '4th Year', 'JONNA MAE', 'NERAL', 'MARQUEZ', '', 'Female', 'Single', 'Filipino', 'Catholic', '2001-01-10', 'Balaoan La Union', 'Guinaburan Balaoan La  Union', 'Lingsat San Fernando La Union', '', 'marquezjonnamae 028@gmail.com', 'Metriano V. Marquez', 'Farmer', '09156661332', 'Josephine N. Marquez', 'Brgy. Utility', '09290590201', 2, 'Lingsat San Fernando', '2025-2026', 'Josephine N. Marquez', 'Guinaburan Balaoan La Union', 'Mother', 'Enrolled', 'Regular', 'college', NULL, '2026-02-10 10:48:27', '2026-02-13 14:16:59');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (14, '2023-00001', '2023-08-17', '3rd Year', 'Drexter', 'Nonog', 'De Vera', '', 'Male', '', '', '', '2005-03-12', '', 'Kimmallogong Sur Naguilian La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2023-2024', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (15, '2023-01844', '2023-03-10', '3rd Year', 'Raychelle', 'Javier', 'Dulay', '', 'Female', 'Single', '', 'Roman Catholic', '2004-04-22', 'Aringay, La Union', 'San Eugenio Aringay La Union', NULL, '', '', 'Edgardo Dulay', 'Fisherman', 'N/A', 'Ray-ann Genese', 'Housewife', 'N/A', 2, NULL, '2023-2024', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (16, '2023-01894', '2023-08-17', '3rd Year', 'Ericka', 'Macanas', 'Escobero', '', 'Female', 'Single', '', 'Roman Catholic', '2005-09-22', 'San Fernando City', 'San Jose Sudipen La Union', NULL, '', '', 'Eric Escobero', 'Barangay Captain', '09453723047', 'Evelyn Andade Macanas', 'Housewife', '09453723047', 2, NULL, '2023-2024', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (17, '2023-00004', '2023-03-10', '3rd Year', 'Mark Anthony', 'aljentera', 'Garcia', '', 'Male', '', '', '', '2004-03-09', '', 'Lingsat San Fernando La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2023-2024', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (18, '2023-00005', '2023-08-17', '3rd Year', 'Janito', 'Cabello', 'Jasmin', '', 'Male', '', '', '', '2005-02-01', '', 'Poblacion Sugpon Ilocos Sur', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2023-2024', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (19, '2023-00006', '2023-03-10', '3rd Year', 'Elizer', 'Cenon', 'Libatique', '', 'Male', '', '', '', '2004-04-10', '', 'Panicsican San Juan La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2023-2024', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (20, '2023-00007', '2023-02-08', '3rd Year', 'Justin', 'Guron', 'Mabalo', '', 'Male', '', '', '', '2005-03-04', '', 'Sitio Galting Casilagan Naguilian La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2023-2024', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (21, '2023-00008', '2023-03-10', '3rd Year', 'Jeremy', 'Buenosaires', 'Mejia', '', 'Female', '', '', '', '2004-10-21', '', 'Poblacion Sudipen La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2023-2024', 'Bernardo Mejia', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (22, '2023-01893', '2023-08-17', '3rd Year', 'Dimple', 'Oliveras', 'Ordinario', '', 'Female', 'Single', '', 'Roman Catholic', '2005-03-15', 'Sudipen, La Union', 'San Jose Sudipen La Union', NULL, '', '', 'Domingoi Ordinario', 'Farmer', '09774467409', 'Welma Oliveras', 'Housewife', '09953611617', 2, NULL, '2023-2024', 'Welma Ordinario', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (23, '2023-00010', '2024-05-10', '3rd Year', 'Mae Florence', 'Espiritu', 'Reyes', '', 'Female', '', '', '', '2005-01-08', '', 'Rimos #4 Luna La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2023-2024', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (24, '2023-01730', '2025-03-10', '3rd Year', 'Melteona', 'Campulat', 'Rimando', '', 'Female', 'Single', '', 'Roman Catholic', '2005-05-04', 'Naguillian, La Union', 'Casilagan Naguilian La union', NULL, '', '', 'Sergio L. Rimando', 'Farmer', '09673973848', 'Mercedes A. Campulat', 'Deceased', 'N/A', 2, NULL, '2023-2024', 'Marcela Rimando', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (25, '2023-01901', '2023-08-17', '3rd Year', 'Mark Laurence', 'Aquino', 'Tejada', '', 'Male', 'Single', '', 'Roman Catholic', '2004-10-11', 'ITRMC', 'Sipulo Bacnotan La Union', NULL, '', '', 'Reynaldo Tejada', 'Admin Assistant', 'N/A', 'Rosemarie B. Aquino', 'Housewife', 'N/A', 2, NULL, '2023-2024', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 08:08:03', '2026-02-12 08:08:03');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (26, '2021-00001', '2023-05-09', NULL, 'Charles Herzon', 'A', 'Cariaga', '', 'Male', 'Single', '', '', '2003-05-23', '', 'Naguirangan San Juan La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2020-2021', 'Melda Cariaga', '', NULL, 'Alumni', NULL, 'college', NULL, '2026-02-12 13:12:15', '2026-02-12 13:12:15');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (27, '2021-00002', '2023-05-09', NULL, 'Jayrich Edison', 'S', 'De Guzman', '', 'Male', 'Single', '', '', '1999-08-16', '', 'Sevilla San Fernando La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2020-2021', 'Erlinda De Guzman', '', NULL, 'Alumni', NULL, 'college', NULL, '2026-02-12 13:12:15', '2026-02-12 13:12:15');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (28, '2021-00003', '2023-05-09', NULL, 'Drex Archer', 'A', 'Gaerlan', '', 'Male', 'Single', '', '', '2002-10-30', '', 'Ili Norte San Juan La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2020-2021', NULL, '', NULL, 'Alumni', NULL, 'college', NULL, '2026-02-12 13:12:15', '2026-02-12 13:12:15');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (29, '2021-00004', '2023-05-09', NULL, 'Lourd Joeibill', 'E', 'Padua', '', 'Male', 'Single', '', '', '2000-10-30', '', 'Ili Norte San Juan La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2020-2021', 'Evelyn Padua', '', NULL, 'Alumni', NULL, 'college', NULL, '2026-02-12 13:12:15', '2026-02-12 13:12:15');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (30, '2021-00005', '2023-05-09', NULL, 'Marcelo', 'R', 'Tugade', '', 'Male', 'Single', '', '', '2003-04-08', '', 'Ili Norte San Juan La Union', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2020-2021', NULL, '', NULL, 'Alumni', NULL, 'college', NULL, '2026-02-12 13:12:15', '2026-02-12 13:12:15');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (31, '2022-01596', '2022-08-12', '4th Year', 'JONA JAIDE', 'LAYCO', 'AYAWAN', '', 'Female', 'Single', 'Filipino', 'Espiritista', '2002-06-30', 'Ezperanza, Dilasag, Aurora', 'Purok 5, Suyo, Bagulin, La Union', 'Purok 5, Suyo, Bagulin, La Union', 'Lingsat San Fernando City La Union', 'jonajaide0630@gmail.com', 'Ruben S. Ayawan', 'Farmer', '09156661332', 'Jonafee Paclibary Layco', 'Furniture Maker', '09156661332', 2, 'Lingsat San Fernando', '2025-2026', 'Jonafee Ayawan', 'Purok 5 ,Suyo, Bagulin La Union', 'Mother', 'Enrolled', 'Regular', 'college', NULL, '2026-02-12 13:28:14', '2026-02-13 14:18:58');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (33, '2022-01592', '0000-00-00', '4th Year', 'Paul Kenneth', 'Dimalanta', 'Marzo', '', 'Male', 'Single', 'Filipino', 'Roman Catholic', '2003-03-03', 'Bethany Hospital, San Fernando, La Union', 'Nadsaag, San Juan, La Union', 'Nadsaag, San Juan, La Union', '', 'paulkennethmarzo999@gmail.com', 'Randy Marzo', 'OFW', 'N/A', 'Rose Dimalanta', 'Chief Assistant', 'N/A', 2, NULL, '2025-2026', 'Camille May Marzo', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 13:28:14', '2026-02-12 13:28:14');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (34, '2022-01663', '0000-00-00', '4th Year', 'Jay Anne Mae', 'Mendoza', 'Piedad', '', 'Female', 'Single', 'Filipino', 'Iglesia Ni Cristo', '2004-04-04', 'Bangbangolan, San Fernando City, La Union', 'Bangbangolan, San Fernando City, La Union', 'Bangbangolan, San Fernando City, La Union', '', 'piedadjayannemae5@gmail.com', 'Joseph L. Piedad', 'Family Driver', '09396120858', 'Levelyn Mendoza Mendoza', 'Housewife', 'N/A', 2, NULL, '2025-2026', 'Joseph Piedad', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-12 13:28:14', '2026-02-12 13:28:14');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (35, '2022-00001', '2023-09-01', '4th Year', 'JOSE ENRIQUE', 'ARQUEZA', 'AGSAULIO', '', 'Male', 'Single', 'FILIPINO', 'BORN AGAIN', '2002-12-16', 'NATIVIDAD NAGUILIAN LA UNION', 'NAGYUBUYUBAN SAN FERNANDO LA UNION', NULL, '', 'N/A', 'JOSE AGSAULIO', 'FARMER', '0946434660', 'ELVIRA AGSAULIO', 'FARMER', '09273766411', 4, NULL, '2024-2025', 'JULIUS AGSAULIO', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (36, '2022-01515', '2023-10-29', '4th Year', 'JHOANA MARIE', 'MARTOS', 'ANCHETA', '', 'Female', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2003-03-07', 'ITRMC', 'AG-AGUMAN TAGUDIN ILOCOS SUR', NULL, '', 'JHOANA MARIE ANCHETA', 'QUINTIN SUPSUPIN', 'DECEASED', 'NONE', 'MARIECREZ ANCHETA', 'SALESLADY', '09312669005', 4, NULL, '2024-2025', 'ERLINDA DIMAYA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (37, '2019-00004', NULL, '4th Year', 'BRENT CARL', 'BUCALA', 'APILADO', '', 'Male', '', 'FILIPINO', '', '2004-06-15', '', 'DALUMPINAS OESTE SAN FERNANDO LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (38, '2022-01531', '2023-09-01', '4th Year', 'MYRA', 'MANAOIS', 'AQUINO', '', 'Female', 'Single', 'FILIPINO', 'CHRISTIAN', '1996-04-15', 'DARIGAYOS LUNA LA UNION', 'DARIGAYOS LUNA LA UNION', NULL, '', 'RAM AQUINO', 'ANTONIO AQUINO', 'DECEASED', 'NONE', 'MARIENE AQUINO', 'BHW', '09304404893', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (39, '2022-01571', NULL, '4th Year', 'CHRISTINE JHOY', 'BALLESTEROS', 'ARCIAGA', '', 'Female', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-01-01', 'CABAROAN SAN JUAN LA UNION', 'CABAROAN SAN JUAN LA UNION', NULL, '', 'CJ ARCIAGA', 'ELMER ARCIAGA', 'BARKER', '09515861044', 'CATHERINE ARCIAGA', 'VENDOR', '09857785013', 4, NULL, '2024-2025', 'CARIDAD BALLESTEROS', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (40, '2022-01622', NULL, '4th Year', 'JHON MARK', 'MABANA', 'ARIOLA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '1993-02-17', 'PARAOIR BALAOAN LA UNION', 'PARAOIR BALAOAN LA UNION', NULL, '', 'JHON MARK ARIOLA', 'ROBERTO ARIOLA', 'FISHERMAN', '09905781558', 'JUANITA ARIOLA', 'DECEASED', 'NONE', 4, NULL, '2024-2025', 'ROWELYN M. ARIOLA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (41, '2022-01637', '2023-07-23', '4th Year', 'JOASH ADRIAN', 'BUCCAT', 'ASPIRAS', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-01-05', 'ITRMC', 'BULALA BACNOTAN LA UNION', NULL, '', 'JOASH ASPIRAS', 'GODFREDO MUNAR JR', 'VENDORS', '09457462241', 'CHRISTY MURAO', 'VENDOR', '09193676894', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (42, '2019-00009', '2023-10-30', '4th Year', 'EDWARD', 'SOBREMONTE', 'BACANI', '', 'Male', '', 'FILIPINO', '', '2003-02-14', '', 'PANICSICAN SAN JUAN LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', 'JUDY BACANI', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (43, '2022-01685', NULL, '4th Year', 'JOHN REY', 'CORTEZ', 'BACANI', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2002-03-27', 'ITRMC', 'CABAROAN SAN JUAN LA UNION', NULL, '', 'JOHN REY BACANI', 'N/A', 'N/A', 'N/A', 'REYSEPINA BACANI', 'HOUSEWIFE', '09289421489', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (44, '2022-01493', NULL, '4th Year', 'NORVIE', 'SUNGDUAN', 'BADENG', '', 'Male', 'Single', 'FILIPINO', 'LUTHERAN', '2004-06-01', 'SANTOL LA UNION', 'LIGUAY PUGUIL SANTOL LA UNION', NULL, '', 'NOVIE BADENG', 'EIDDE BADENG', 'FARMER', 'N/A', 'SULITA DUNGDUAN', 'FARMER', 'N/A', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (45, '2022-01519', '2023-09-01', '4th Year', 'BRYAN', 'VARELA', 'BALALA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-01-01', 'ITRMC', 'NALVO SUR LUNA LA UNION', NULL, '', 'BRYAN BALALA', 'JOEY BALALA', 'TRICYCLE DRIVER', '09668595351', 'EDNA V. BALALA', 'HOUSE WIFE', 'N/A', 4, NULL, '2024-2025', 'NECA BALALA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (46, '2022-01625', '2023-10-30', '4th Year', 'MARK JOHN LEE', 'R', 'BAUTISTA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-06-18', 'BACNOTAN LA UNION', 'DARIGAYOS LUNA LA UNION', NULL, '', 'MARK JOHN LEE', 'DOMINGO BAUTISTA', 'FISHERMAN', '09777451701', 'LEAH BAUTISTA', 'HOUSE WIFE', '09157501007', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (47, '2022-01701', NULL, '4th Year', 'GABRIEL', 'PAGUIRIGAN', 'BEJO', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', NULL, 'QUEZON CITY', 'BUTUBUT NORTE BALAOAN LA UNION', NULL, '', 'GABREILBEJO S34', 'RICHMOND BEJO', 'FARMER', '9668414096', 'NORA PAQGUIRIGEN', 'HOUSE WIFE', '09920024899', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (48, '2022-01543', '2023-09-01', '4th Year', 'ALDRIN PAUL', 'OPENA', 'BISCARRA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-11-05', 'SANTOL LA UNION', 'LETTAC SUR SANTOL LA UNION', NULL, '', 'ALDRIN BISCARRA', 'EDUARDO BSICARRA', 'N/A', '09632455436', 'NENITA BISCARRA', 'N/A', '09501108233', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (49, '2019-00016', NULL, '4th Year', 'NIKKO VINCE', 'M', 'BLANCO', '', 'Male', '', 'FILIPINO', '', '2003-12-14', '', 'DARIGAYOS LUNA LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', 'GARARDA BLANCO', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (50, '2022-01669', NULL, '4th Year', 'GUIN', 'TUAZON', 'BOADILLA', '', 'Female', 'Single', 'FILIPINO', 'UMC', '2003-02-14', 'SUPO TUBO ABRA', 'LEGASPI GALIMUYOD ILOCOS SUR', 'LINGSAT SAN FERNANDO', '', 'GUIN TUASON BOADILLA', 'RODOLFO G BOADILLA JR.', 'FARMING', '09091700300', 'RICA LUIS TUAZON', 'HOUSE WIFE', '09931415226', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (51, '2022-01623', '2023-09-01', '4th Year', 'MARK RYAN', 'MORALES', 'BONGOLAN', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-09-10', 'ITRMC', 'PARAOIR BALAOAN LA UNION', NULL, '', 'MARK RYAN BONGOLAN', 'RANDY BONGOLAN', 'NONE', '09482899137', 'EVELYN MORALES', 'NONE', '09302702799', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (52, '2019-00019', '2022-05-15', '4th Year', 'RONA', 'ERECE', 'BUCSIT', '', 'Female', '', 'FILIPINO', '', '2003-03-27', '', 'ILOCANOS SUR SAN FERNANDO LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (53, '2019-00020', '2022-11-08', '4th Year', 'JOHNSON', 'B', 'BUGTONG', '', 'Male', '', 'FILIPINO', '', '2003-01-20', '', 'DARDARAT TAGUDIN ILOCOS SUR', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (54, '2022-01578', '2023-10-26', '4th Year', 'RIZZA MAE', 'BAGBAGO', 'BUGTONG', '', 'Female', 'Single', 'FILIPINO', 'FEARECOST', '2004-09-13', 'SAN JUAN CERVANTES ILOCOS SUR', 'DARDARAT TAGUDIN ILOCOS SUR', 'N/A', '', 'rizza mae bugtong', 'RENATO BUGTONG', 'BUSINESS OWNER', '09573118415', 'NAYSAN BUGTONG', 'SELLER', '09100600575', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (55, '2022-01662', '2023-08-13', '4th Year', 'ROMEO JR.', 'LATONG', 'BULAGSAY', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2002-01-21', 'TUGPON ILOCOS SUR', 'POBLACION SUGPON ILOCOS SUR', 'LINGSAT SAN FERNANDO', '', 'N/A', 'ROMEO BUTAGSAY SR.', 'FARMER', '09959488480', 'MENCHU ENPONGOZA', 'OFW', 'N/A', 4, NULL, '2024-2025', 'ROMELA BULAGSAY', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (56, '2022-01573', NULL, '4th Year', 'RIZZA MAE', 'DACUMOS', 'CABANBAN', '', 'Female', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-12-18', 'NONE', 'DANGDANGLA SAN JUAN LA UNION', NULL, '', 'RIZZA MAE CABANBAN', 'VENARCIO CABANBAN', 'N/A', 'N/A', 'CONOTANUA D. CABANBAN', 'TRANSIENT MAINTENACE', '09079494397', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (57, '2022-01719', '2023-10-23', '4th Year', 'ELLA MARIE', 'DELIZO', 'CACDAC', '', 'Female', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2003-02-10', 'SAN FERNANDO LA UNION', 'LIOAC NORTE NAGUILIAN LA UNION', NULL, '', 'NONE', 'OSWALDO CACDAC', 'DECEASED', 'NONE', 'ROSIE DELIZO', 'HOUSE MAID', '09817455092', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (58, '2022-01492', '2023-09-01', '4th Year', 'JAN-JAN', 'TAGABAN', 'CALINGLING', '', 'Male', 'Single', 'FILIPINO', 'LUTHERAN', '2004-05-06', 'SANTOL LA UNION', 'LIGUAY PUGUIL SANTOL LA UNION', NULL, '', 'JANJAN TAQOBAN', 'JHONNY SIB-AT CALINGLING', 'N/A', 'N/A', 'JENNYLYN TAGABAN', 'HOUSEKEEPER', '09260952247', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (59, '2022-01607', '2023-02-08', '4th Year', 'EDWARD', 'OJASCASTRO', 'CAMAT', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2002-01-16', 'SANTOL LA UNION', 'PILAOAN CORRO-OY SANTOL LA UNION', NULL, '', 'EDWARD CAMAT', 'EFREN CAMAT', 'NONE', 'N/A', 'ELENA CAMAT', 'NONE', 'N/A', 4, NULL, '2024-2025', 'EDMON CAMAT', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (60, '2022-01688', '2023-05-21', '4th Year', 'DIENOEL', 'LOPE', 'CAMILOT', '', 'Male', 'Single', 'FILIPINO', 'LUTHERAN', '2003-11-01', 'BENGUET HOSPITAL', 'MAGGEW PUGUIL SANTOL LA UNION', NULL, '', 'DIENOEL CAMILOT', 'DIEGO CAMILOT B.', 'FARMER', '09199469113', 'LEONIE CALONG LOPE', 'OFW', 'N/A', 4, NULL, '2024-2025', 'NICOLAS CAMILOT', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (61, '2019-00028', '2022-10-16', '4th Year', 'REY', 'T', 'CARDENAS', '', 'Male', '', 'FILIPINO', '', '2003-04-15', '', 'CORRO-OY SANTOL LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (62, '2022-01668', '2023-10-13', '4th Year', 'JOVAN', 'CASILANG', 'CARINO', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2003-11-13', 'SAN FERNANDO LA UNION', 'SAGAYAD SAN FERNANDO LA UNION', NULL, '', 'NONE', 'EDDIE CARINO', 'FARMER', 'N/A', 'VIRGIE CARINO', 'HOUSEKEEPING', 'N/A', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (63, '2022-01525', '2023-10-13', '4th Year', 'MARL FLORENCE', 'RAGMAC', 'CARTA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-06-04', 'BALAOAN LA UNION', 'CABUAN-AN BALAOAN LA UNION', 'N/A', '', 'MARL FLORENCE CARTA', 'MARLOU CARTA', 'FARMER', 'N/A', 'FLORABETH RAGMAC', 'HOUSEWIFE', '09397201773', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (64, '2022-01554', '2023-10-26', '4th Year', 'FRANCIS CARLO', 'COSTALES', 'COLLADO', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-07-20', 'ITRMC', 'TABOC SAN JUAN LA UNION', NULL, '', 'CARLO COLLADO', 'RYAN COLLADO', 'OFW', NULL, 'JOANN COLLADO', 'SERVICE CREW', '09670629730', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (65, '2019-00031', '2023-10-25', '4th Year', 'JOMAR', 'CUDLAS', 'DANSALAN', '', 'Male', '', 'FILIPINO', '', NULL, '', 'DECCAN PUGUIL SANTOL LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', 'JEFFREY DANSALAN', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (66, '2022-01665', '2023-07-23', '4th Year', 'JOHN FRENIEL', 'SADAO', 'DEGAN', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2000-09-07', 'SAN FERNANDO LA UNION', 'SUGPON ILOCOS SUR', NULL, '', 'JOHN FRENIEL', 'ALFREDO DEGAN', 'FARMER', '09614249369', 'JOVY DEGAN', 'OFW', 'N/A', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (67, '2022-01583', '2023-10-26', '4th Year', 'MARK DOMINIC', 'HIPONA', 'DIGA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-10-22', 'ITRMC', 'TABOC SAN JUAN LA UNION', NULL, '', 'MARK DOMINIC DIGA', 'SIMEON DIGA JR.', 'DPWH', '09487780332', 'CAROLINA DIGA', 'HOUSEKEEPER', '09468379224', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (68, '2022-01699', NULL, '4th Year', 'JENELYN', 'DIMAL', 'DOLOR', '', 'Female', 'Single', 'FILIPINO', 'BORN AGAIN CHRISTIAN', '2003-01-09', 'SAN RAMON MANAOAG PANGASINAN', 'SEVILLA SAN FERNANDO LA UNION', NULL, '', 'JENELYN DOLOR', 'RODRIGO DOLOR', 'FARMER', 'N/A', 'ROBELINDA DIMAL', 'HOUSEWIFE', '09387690177', 4, NULL, '2024-2025', 'ELSIE VALDEZ', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (69, '2022-01605', '2023-10-13', '4th Year', 'CIRYL DAVE', 'ORDINARIO', 'DOMINGO', '', 'Male', 'Single', 'FILIPINO', 'BORN AGAIN', '2000-08-02', 'NONE', 'LINGSAT SAN FERNANDO LA UNION', NULL, '', 'NONE', 'JERULO DOMINGO', 'SALES MAN', '09772439019', 'ELEONOR ORDINARIO', 'HOUSEWIFE', 'N/A', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (70, '2022-01546', '2023-07-23', '4th Year', 'JOHN PATRICK ELIZER', 'SANSANO', 'DOMINGO', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2003-11-30', 'BAGUIO CITY', 'PAAGAN SANTOL LA UNION', NULL, '', 'JP DOMINGO', 'JUNNIFER O DOMINGO', 'CARPENTER', '09957630242', 'ELIZABETH SANSANO', 'HOUSE WIFE', '09164139479', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (71, '2019-00037', '2022-09-08', '4th Year', 'LIEZYL FATE', 'CASUGAY', 'DUCUSIN', '', 'Female', '', 'FILIPINO', '', '2004-02-25', '', 'CASILAGAN NAGUILIAN LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (72, '2022-01600', '2023-10-26', '4th Year', 'CLIVE', 'COSTALES', 'DUCNAN', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2001-06-18', 'SAN FERNANDO LA UNION', 'TABOC SAN JUAN LA UNION', NULL, '', 'DUCNAN CLIVE', 'CHARLES DUCNAN', 'NONE', '0969458001', 'OLIVE COSTALES', 'OFW', 'NONE', 4, NULL, '2024-2025', 'ROSARIO COSTALES', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (73, '2019-00039', NULL, '4th Year', 'VINCENT ARLO', 'DULCE', 'ESTRADA', '', 'Male', '', 'FILIPINO', '', '2002-07-31', '', 'LINGSAT SAN FERNANDO LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (74, '2019-00040', '2023-07-23', '4th Year', 'MARK JAYSON', 'ORINE', 'FERRERAS', '', 'Male', '', 'FILIPINO', '', '2003-04-25', '', 'BUTUBUT NORTE BALAOAN LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (75, '2022-01562', '2023-07-23', '4th Year', 'ELBERT JOHN', 'ZAMORANOS', 'FLORES', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2003-05-09', 'NONE', 'DALLANGAYAN OESTE SAN FERNANDO LA UNION', NULL, '', 'ELBERT JOHN FLORES', 'GILBERT FLORES', 'MAINTENANCE', '09544729918', 'ELMA FLORES', 'LADY GUARD', 'N/A', 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (76, '2022-01557', '2023-05-21', '4th Year', 'RUBELYN', 'CALICA', 'GACAYAN', '', 'Female', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2001-09-16', 'NAGUILIAN, LA UNION', 'PAO NORTE SAN FERNANDO LA UNION', NULL, '', 'RUBELYN CALICA GACAYAN', 'ROBERT GACAYAN', 'FARMER', '09197592595', 'ELIZABETH CALICA', 'BRGY UTILITY', '09078036797', 4, NULL, '2024-2025', 'DWAYNE FERDINAND APRECIO', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (77, '2022-01564', NULL, '4th Year', 'LEANZA MAY', 'FABRO', 'GACUSAN', '', 'Female', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-08-08', 'TAGUDIN ILOCOS SUR', 'DALAWA ALILEM ILOCOS SUR', NULL, '', 'LEANZA MAY FABRO GACUSAN', 'JUN GACUSAN', 'FARMER', 'N/A', 'DIVINA FABRO', 'OFW', 'N/A', 4, NULL, '2024-2025', 'GIANNE MARA GACUSAN', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (78, '2019-00044', '2023-01-08', '4th Year', 'JOHN REY', 'CANELA', 'GALANO', '', 'Male', '', 'FILIPINO', '', '2004-04-27', '', 'PAAGAN SANTOL LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', 'ANGELICA AREOLA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (79, '2022-01551', '2023-10-14', '4th Year', 'JEROLL', 'RUBIS', 'GARCIA', '', 'Male', '', 'FILIPINO', '', '2004-10-21', '', 'CABALAYANGAN LA UNION', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2024-2025', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (80, '2022-01550', '2025-11-14', '4th Year', 'JORELL', 'RUBIS', 'GARCIA', '', 'Male', 'Single', 'FILIPINO', 'CATHOLIC', '2004-10-21', 'SAN FERNANDO LA UNION', 'CABALAYANGAN LA UNION', NULL, '', 'NONE', 'NONE', 'NONE', 'NONE', 'RAQUEL R. GARCIA', 'NONE', 'NONE', 4, NULL, '2025-2026', NULL, '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (81, '2022-01677', '2025-11-14', '4th Year', 'RALPH JUSTIN', 'ANGAGAN', 'GERONILLA', '', 'Male', 'Single', 'FILIPINO', 'A.G.', '2004-07-19', 'POBLACION G. DEL PILAR ILOCOS SUR', 'CONCEPTION G. DEL PILAR ILOCOS SUR', 'BIDAY SAN FERNANDO LA UNION', '', 'RALPH GERONILLA', 'JEFFERSON GERONILLA', 'LABORER', '9534176222', 'ROWENA ANGAGAN', 'LABORER', '9534176222', 4, NULL, '2025-2026', 'JOB GIRONELLA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (82, '2022-01534', '2025-11-09', '4th Year', 'CARLOS JAY', 'NAVARRO', 'GRAYCOCHEA', '', 'Male', 'Single', 'FILIPINO', 'BORN AGAIN', '2003-09-28', 'SAN FERNANDO LA UNION', 'PANTAR NORTE BALAOAN LA UNION', NULL, '', 'CARLOS JAY GRAYCOCHEA', 'JOHN B. OYANDO', 'NONE', 'NONE', 'NATIVIDAD N. GRAYCOCHEA', 'N/A', '09121220271', 4, NULL, '2025-2026', 'NATIVIDAD GRAYCOCHEA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (83, '2022-01553', '2025-11-10', '4th Year', 'JHAZMIER LEE', 'TUGADE', 'ILAGAN', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-11-04', 'ITRMC', 'TABOC SAN JUAN LA UNION', NULL, '', 'JHAZMIER ILAGAN', 'N/A', 'N/A', 'NONE', 'JENNIEMER LOU T. ILAGAN', 'OFW', 'NONE', 4, NULL, '2025-2026', 'FLORENCIA M. TUGADE', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (84, '2022-01610', '2025-11-10', '4th Year', 'CARLO', 'LONGOS', 'JUCUTAN', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2002-08-23', 'BACSIL, SAN FERNANDO LA UNION', 'BACSIL, SAN FERNANDO LA UNION', NULL, '', 'CARLO JUCUTAN', 'CLETO B. JUCUTAN', 'RETIRED POLICE', 'NONE', 'FERLD LANGOS VICIO', 'HOUSE WIFE', '0966602555', 4, NULL, '2025-2026', 'PERLA LANGOS VICIO', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (85, '2022-01630', '2025-11-11', '4th Year', 'JOHN ROLEX', 'MALVAR', 'LACONSAY', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-05-29', 'SOLSONA, ILOCOS NORTE', 'SEVILLA SAN FERNANDO LA UNION', NULL, '', 'JOHN ROLEX MAVAR LACONSAY', 'N/A', 'N/A', 'NONE', 'REGIELYN MALAQUI', 'MESSENGER', '09481582951', 4, NULL, '2025-2026', 'REGIELYN LACONSAY', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (86, '2022-01642', '2025-11-19', '4th Year', 'REDENTOR', 'SALDAEN', 'LACPAP', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-03-23', 'SAN JUAN CERVANTES ILOCOS SUR', 'SAN JUAN, CERVANTES, ILOCOS SUR', 'STIVER ST. LINGSAT SAN FERNANDO LA UNION', '', 'REIDEN LACPAP', 'REX LACPAP', 'FARMER', '09543283675', 'IRENE SALDAEN', 'HOUSEWIFE', '09270113813', 4, NULL, '2025-2026', 'IRENE LACPAP', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (87, '2022-01511', '2025-11-19', '4th Year', 'CHRISTIAN', 'LIRASAN', 'LIUP', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-12-17', 'MANILA', 'MAGALLANES, LUNA LA UNION', NULL, '', 'CHRISTIAN LIRASAN LIUP', 'RODOLFO LIUP', 'DRIVER', '09318375698', 'ANALIZA LIUP', 'HOUSE WIFE', '09705173942', 4, NULL, '2025-2026', 'ANALIZA LIUP', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (88, '2022-01636', '2025-11-09', '4th Year', 'JOHN PAUL', 'FALCUNIT', 'LICTAOA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2001-09-22', 'STA. ANA PATEROS MANILA', 'DASAY, SAN JUAN LA UNION', 'N/A', '', 'N/A', 'JOEL M. LICTAOA', 'CONSTRUCTION WORKER', '09128307251', 'FLORDELIZA F. LICTAOA', 'HOUSEWIFE', 'N/A', 4, NULL, '2025-2026', 'JOEL M. LICTAOA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (89, '2023-01946', '2025-11-21', '4th Year', 'JHON JOSEPH', 'TEJADO', 'LATONG', '', 'Male', 'Single', 'FILIPINO', 'CHRISTIAN', '2004-02-12', 'TAGUDIN, ILOCOS SUR', 'DUPLAS, SUDIPEN, LA UNION', NULL, '', 'N/A', 'RAFF LATONG', 'FARMING', 'N/A', 'LEONURA TEJADA', 'OFW', 'N/A', 4, NULL, '2025-2026', 'RUTHALYN MAE LATONG', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (90, '2022-31582', '2025-11-24', '4th Year', 'ESMAEL', 'DALUMPINES', 'LUBRICA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2003-01-17', 'SAN FERNANDO LA UNION', 'SAGAYAD SAN FERNANDO LA UNION', NULL, '', 'MAEL LUBRICA', 'REGINO LUBRICA', 'PGLU DRIVER', '09953604515', 'OFELIA LUBRICA', 'GOVERNMENT EMPLOYEE', '09394787746', 4, NULL, '2025-2026', 'RACHEL LUBRICA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (91, '2022-01588', NULL, '4th Year', 'JOMAR', 'C', 'LUBRICA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2003-12-09', 'SAN FERNANDO LA UNION', 'SAGAYAD SAN FERNANDO LA UNION', 'N/A', '', 'LUBRICA JOMAR', 'RONALDO O. LUBRICA', 'SECURITY GUARD', '09632179205', 'MARILYN M. CARINO', 'HOUSE KEEPING', 'N/A', 4, NULL, '2025-2026', 'RONALYN LUBRICA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (92, '2021-01406', '2025-11-24', '4th Year', 'LESTER', 'DALUMPINES', 'LUBRICA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '1999-03-11', 'SAN FERNANDO LA UNION', 'SAGAYAD SAN FERNANDO LA UNION', NULL, '', 'LESTER DALUMPINES LUBRICA', 'REGINO LUBRICA', 'PGLU DRIVER', '09953604515', 'OFELIA LUBRICA', 'GOVERNMENT EMPLOYEE', '09474807746', 4, NULL, '2025-2026', 'REGINO LUBRICA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (93, '2022-01561', '2025-11-20', '4th Year', 'EDBERG', 'FLORES', 'MABALO', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-03-23', 'NAGUILIAN, LA UNION', 'BIDAY, SAN FERNANDO LA UNION', NULL, '', 'EDBERG MABALO', 'JOHN MABALO', 'FARMER', '090534111935', 'JAY FLORES', 'OFW', 'N/A', 4, NULL, '2025-2026', 'JOHN MABALO', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (94, '2022-01628', '2025-11-19', '4th Year', 'CHEIN-YEE', 'LAG-ASAN', 'MAKINAS', '', 'Female', 'Single', 'FILIPINO', 'CDCC', '2004-01-22', 'MAN-ALONG SUYO ILOCOS SUR', 'MAN-ALONG, SUYO, ILOCOS SUR', 'LINGSAT SAN FERNANDO', '', 'N/A', 'PEDRO MARINAS', 'FARMER', 'N/A', 'DOLORES CONDUGO', 'N/A', 'N/A', 4, NULL, '2025-2026', 'FELLY CORTEZ', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (95, '2022-01236', '2025-11-28', '4th Year', 'DARIEL', 'ESTONILLA', 'MENDOZA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-09-17', 'ITRMC', 'NAGSABARAN, SAN JUAN, LA UNION', NULL, '', 'N/A', 'ARIEL MENDOZA', 'TANOD', '09281526486', 'IMELDA ESTANILLA', 'VENDOR', '09194821381', 4, NULL, '2025-2026', 'IMELDA ESTANILLA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (96, '2022-01586', '2025-11-19', '4th Year', 'SHIELA MAE', 'RODRIGUEZ', 'LEONARDO', '', 'Female', 'Single', 'FILIPINO', 'BAPTIST', '2004-04-20', 'SAN MATEO ISABELA', 'LETTAC SUR SANTOL LA UNION', 'CARLATAN CITY OF SAN FERNANDO', '', 'SHIELA MAE LEONARDO', 'ERNESTO LEONARDO JR.', 'JEEPNEY DRIVER', 'N/A', 'MYRAFLOR G. RODRIGUEZ', 'OFW', 'N/A', 4, NULL, '2025-2026', 'FLOSDELINA G. RODRIGUEZ', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (97, '2022-01577', '2025-11-24', '4th Year', 'ALEXANDER', 'TORRES', 'LUBENARIA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-08-03', 'BUNGOL, BALAOAN, LA UNION', 'ILI SUR SAN JUAN LA UNION', NULL, '', 'ALEXANDER LUBENARIA', 'ALEXANDER LUBENARIA SR.', 'FARMER', 'N/A', 'BENESSIA LUBENARIA', 'FARMER', 'N/A', 4, NULL, '2025-2026', 'JESSIE LUBENARIA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (98, '2021-01634', '2025-11-21', '4th Year', 'CAMERON JOHN', 'PIMENTEL', 'LEIZA', '', 'Male', 'Single', 'FILIPINO', 'ASSEMBLY OF GOD', '2003-06-01', 'ILOCOS SUR', 'CONCEPTION CERVANTES, ILOCOS SUR', 'SAGAYAD SAN FERNANDO LA UNION', '', 'CAMERON JOHN P. LEIZA', 'HONEY HANZEL M. LEIZA', 'LABORER', 'N/A', 'MARICOR PIMENTEL', 'HOUSE WIFE', '09124325381', 4, NULL, '2025-2026', 'MARIOR LEIZA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (99, '2022-01512', '2025-11-25', '4th Year', 'ARDIE BOY', 'BUSTAMANTE', 'MILLARES', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-08-03', 'CUBAO LA UNION', 'CUBAO LA UNION', 'N/A', '', 'ARDIE MILLARES', 'RUEL MILLARES', 'FARMER', '09123878762', 'AGNES MILLARES', 'HOUSE WIFE', '09123878762', 4, NULL, '2025-2026', 'AGNES MILLARES', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (100, '2022-01529', '2025-11-21', '4th Year', 'JOHN MIKE', 'RAGMAC', 'MONIS', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2003-08-16', 'BANGAR LA UNION', 'LETTAC SUR SANTOL LA UNION', NULL, '', 'JOHN MIKE MONIS', 'MICHAEL M MONIS', 'LABORER', '09464561728', 'VILMA ORILLO RAGMAC', 'HOUSEWIFE', '09707778059', 4, NULL, '2025-2026', 'VILMA MONIS', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (101, '2022-01619', '2025-11-19', '4th Year', 'JC-LYN', 'PAQUEDAN', 'MORALES', '', 'Female', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-10-17', 'ITRMC', 'PANTAR SUR BALAOAN LA UNION', NULL, '', 'JC-LYN MORALES', 'JESUS MORALES', 'FARMER', '09128820149', 'MODELYN MORALES', 'VENDOR', '09663148035', 4, NULL, '2025-2026', 'MADELYN MORALES', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (102, '2022-01693', '2025-11-19', '4th Year', 'SAMANTHA NICOLE', 'CARCIA', 'MUNAR', '', 'Female', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-03-19', 'SAN FERNANDO LA UNION', 'SAN FRANCISCO SAN FERNANDO LA UNION', NULL, '', 'SAMANTHA NICOLE MUNAR', 'WILLIAM MUNAR', 'DECEASED', 'N/A', 'MA GENEROSA MUNAR', 'DECEASED', 'N/A', 4, NULL, '2025-2026', 'RIZALINA F. MUNAR', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (103, '2022-0115', '2025-11-24', '4th Year', 'ALLEN ROBINSON', 'FALLOSCO', 'NALUNPASAN', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-04-13', 'ITRMC', 'ALMIEDA BALAOAN LA UNION', NULL, '', 'ALLEN ROBINSON NALUNDASAN', 'RUBEN NALUNDASAN', 'PRIVATE SECURITY', '09517120204', 'ELENA NALUNDASAN', 'HOUSE WIFE', '09814733468', 4, NULL, '2025-2026', 'RUBEN NALUNDASAN', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (104, '2022-01638', '2025-11-24', '4th Year', 'HANS', 'C', 'MARZO', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-06-10', 'ITRMC', 'PARAOIR BALAOAN LA UNION', 'N/A', '', 'HANS RDG NAROD', 'RODOLFO MARZO JR', 'BRGY OFFICIAL', '09951688316', 'CHAVELE MARZO', 'MAID WIFE', '09503235367', 4, NULL, '2025-2026', 'RODOLFO MARZO JR', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (105, '2022-01855', '2025-11-20', '4th Year', 'REINZEL', 'L', 'NATIVIDAD', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-11-28', 'TAGUDIN, ILOCOS SUR', 'CANDON CITY ILOCOS SUR', NULL, '', 'NATIVIDAD', 'RENE NATIVIDAD', 'DRIVER', 'N/A', 'MARICELBUNGED', 'OFW', 'N/A', 4, NULL, '2025-2026', 'MICHAEL NATIVIDAD', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (106, '2022-01548', '2025-11-18', '4th Year', 'KENETH VANDAME', 'SONATE', 'NATURA', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2003-10-31', 'BALAOAN LA UNION', 'BALAOAN LA UNION', NULL, '', 'N/A', 'RODEL A NATURA', 'FARMER', '09519028604', 'ROMELIA CONATE', 'HOUSE WIFE', '09700659694', 4, NULL, '2025-2026', 'RODEL NATURA', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (107, '2022-01520', '2025-11-21', '4th Year', 'NATHANIEL TJ', 'CABALONGAN', 'NAVARETTE', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-01-25', 'DARIGAYOS LUNA LA UNION', 'DARIGAYOS LUNA LA UNION', 'N/A', '', 'TJ NAVARETTE', 'TRUJILLO NAVARETTE', 'FARMER', '09295252163', 'JUVELYN NAVARETTE', 'STORE OWNER', '09562911945', 4, NULL, '2025-2026', 'TOJUTILLO B NAVARETTE', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (108, '2022-01010', '2025-11-18', '4th Year', 'EDDIE BOY', 'GENITA', 'AIRO', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', NULL, 'MAGALLANES LUNA LA UNION', 'MAGALLANES, LUNA LA UNION', NULL, '', 'EDDIEBOY NIRO', 'EDUARDO NIRO', 'FISHERMAN', '09480807188', 'ADELAIDA GENITA', 'HOUSE WIFE', '09485507168', 4, NULL, '2025-2026', 'ADELAIDA NIRO', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');
INSERT INTO `students` (`id`, `student_id`, `registration_date`, `year_level`, `first_name`, `middle_name`, `last_name`, `extension_name`, `gender`, `civil_status`, `nationality`, `religion`, `date_of_birth`, `place_of_birth`, `address`, `resedential_address`, `boarding_house_address`, `email_fb_account`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `course_id`, `section`, `school_year`, `guardian_name`, `guardian_address`, `guardian_relationship`, `status`, `enrolled_status`, `education_level`, `is_deleted`, `created_at`, `updated_at`) VALUES (109, '2022-01509', '2025-11-21', '4th Year', 'SHWERWIN JAKE', 'CORPUZ', 'NISPEROS', '', 'Male', 'Single', 'FILIPINO', 'ROMAN CATHOLIC', '2004-10-31', 'SAN FERNANDO LA UNION', 'TANQUIGAN SAN FERNANDO CITY', NULL, '', 'NONE', 'SONNY NISPEROS', 'FOREMAN', '09074420088', 'MARITES ASPILLAGA', 'COOK', '09757850090', 4, NULL, '2025-2026', 'MARITES NISPEROS', '', NULL, 'Enrolled', NULL, 'college', NULL, '2026-02-13 15:23:08', '2026-02-13 15:23:08');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '0:user, 1:admin',
  `office` enum('admin','scholar','clinic','alumni','sbo','gad','sport','marshall','guidance') NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0:active, 1:inactive, ',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (2, 'Rhogia Kaye T.', 'Brillantes', 'admin@gmail.com', '$2y$10$2oEc0ibUGFKqkRzN3gbzOu53ZXICFZgH3VtrvXYK4TCV3P9UlWtJm', 1, 'admin', 0, '2025-09-08 11:05:36', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (5, 'Jonalyn J.', 'Ablan', 'guidance@gmail.com', '$2y$10$E5bDSmOuKvrsSX/SQ/DnkOgQgQXRl9RAH6ZS8m04GotE5udDkkuNS', 1, 'guidance', 0, '2025-09-29 08:57:57', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (6, 'Erwin O.', 'Labiano', 'clinic@gmail.com', '$2y$10$V635ka2.VmwgFYq2EHjnSuwYHuy24T2fY/eeI2P5V/WZ0F/xFDDK.', 0, 'clinic', 0, '2025-09-29 08:58:34', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (7, 'Teresa', 'Tara', 'alumni@gmail.com', '$2y$10$WCRCzb9Gq9qO6ONThl0RVO4SRI6MNhwVDngNrzpegBvQQBCfIllkK', 0, 'alumni', 0, '2025-09-29 08:59:46', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (8, 'Mary Ann', 'De Guzman', 'scholar@gmail.com', '$2y$10$EwMd8VD87GImkX8r/IJQWOa3rn0i8CldM38L9MfkuSYtWoEDcXNIy', 1, 'scholar', 0, '2025-10-17 14:45:56', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (9, 'Charlene Joy', 'Estandian', 'gad@gmail.com', '$2y$10$qpdf0lIPhJjCMpb3/tt69.PKnR8rpn6AcXQrWX8R9v4VXLILX34q2', 1, 'gad', 0, '2025-10-17 14:46:02', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (10, 'Pamela', 'Corpuz', 'marshall@gmail.com', '$2y$10$eS7TlHgitiSbB8oReOxXVujGEYOY0RVbwbM21dlDB7Mjlul6iJyUO', 0, 'marshall', 0, '2025-10-17 14:46:39', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (11, 'Chiquita', 'Shannon', 'xapyhe@mailinator.com', '$2y$10$cGYc45M5W2A6bUK5LpijoeQMVHidyto/fWcippwffQ5Wx75a.QNOe', 1, 'clinic', 0, '2025-10-17 14:47:53', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (12, 'Paul John', 'Macaranas', 'sport@gmail.com', '$2y$10$5Y3noCJbgC0ouQp4asJGieXyDG8EDm6/NepoGMN.Hfz.uHxbMobMm', 1, 'sport', 0, '2025-10-17 14:48:26', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (13, 'Clinic', 'Clinic', 'clinic12@gmail.com', '$2y$10$ZE9CRSmdzHN7dfl3O42dWuCG2/iTV9COd1TNm.XQlxh0UlEdZkwWG', 0, 'clinic', 0, '2025-11-09 11:39:33', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (14, 'Julian', 'Shaw', 'alumni@mailinator.com', '$2y$10$DK6kGVk3FAnZUe/Kmr3bm.KRQepSqZtV9VsgdYF/Mum2MWA6jORLm', 0, 'alumni', 0, '2025-11-13 16:24:17', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `office`, `status`, `created_at`, `updated_at`) VALUES (15, 'Noel', 'Mcgowan', 'bila@mailinator.com', '$2y$10$yXfwGo5ba2moEjWH.loAkefJhOq0994UsoI/GUfMlbvigNhLD3Yka', 1, 'alumni', 1, '2025-11-13 16:24:55', NULL);


#
# TABLE STRUCTURE FOR: vehicle_tracers
#

DROP TABLE IF EXISTS `vehicle_tracers`;

CREATE TABLE `vehicle_tracers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL COMMENT 'connected to students.id',
  `vehicle_plate_no` varchar(50) NOT NULL,
  `vehicle_type` varchar(100) NOT NULL DEFAULT '',
  `schedule` datetime DEFAULT NULL,
  `purpose_of_travel` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `vehicle_tracers` (`id`, `driver_id`, `vehicle_plate_no`, `vehicle_type`, `schedule`, `purpose_of_travel`, `created_at`, `updated_at`) VALUES (1, 0, 'Mollit reprehenderit', '', '0000-00-00 00:00:00', 'Test', '2025-11-05 09:22:06', '2026-03-01 16:24:02');
INSERT INTO `vehicle_tracers` (`id`, `driver_id`, `vehicle_plate_no`, `vehicle_type`, `schedule`, `purpose_of_travel`, `created_at`, `updated_at`) VALUES (2, 0, 'Duis voluptatibus et', '', '0000-00-00 00:00:00', 'Est culpa reiciend', '2025-11-05 12:02:14', '2025-11-06 02:26:37');
INSERT INTO `vehicle_tracers` (`id`, `driver_id`, `vehicle_plate_no`, `vehicle_type`, `schedule`, `purpose_of_travel`, `created_at`, `updated_at`) VALUES (3, 97, '3312', 'Facere inventore et', '0000-00-00 00:00:00', 'dasd', '2026-03-01 10:32:45', '2026-03-01 10:33:06');


#
# TABLE STRUCTURE FOR: vehicle_tracers_passenger
#

DROP TABLE IF EXISTS `vehicle_tracers_passenger`;

CREATE TABLE `vehicle_tracers_passenger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_tracers_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `vehicle_tracers_passenger` (`id`, `vehicle_tracers_id`, `student_id`, `created_at`, `updated_at`) VALUES (2, 3, 97, '2026-03-01 10:33:06', NULL);
INSERT INTO `vehicle_tracers_passenger` (`id`, `vehicle_tracers_id`, `student_id`, `created_at`, `updated_at`) VALUES (3, 3, 99, '2026-03-01 10:33:06', NULL);


#
# TABLE STRUCTURE FOR: violations
#

DROP TABLE IF EXISTS `violations`;

CREATE TABLE `violations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `violation` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (1, 'S', 'Stocking', 0, '2025-10-12 09:35:56', '2026-02-12 14:26:04');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (2, 'IMPU', 'Improper Uniform', 0, '2025-10-12 09:35:56', '2026-02-12 14:26:40');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (3, 'NWU', 'Not Wearing Uniform', 0, '2025-10-12 09:35:56', '2026-02-12 14:24:37');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (4, 'WB', 'Wrong Bag', 0, '2025-10-12 09:35:56', '2026-02-12 14:25:13');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (5, 'NW', 'No Whistle', 0, '2025-10-12 09:35:56', '2026-02-12 14:26:17');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (6, 'NID', 'No ID', 0, '2025-10-12 09:35:56', '2026-02-12 14:24:54');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (7, 'WI', 'Wrong Inner', 0, '2025-10-12 09:35:56', '2026-02-12 14:25:27');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (8, 'SMOKING', 'Smoking in School Premises', 0, '2025-10-12 09:35:56', '2025-10-12 09:35:56');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (9, 'TEST', 'Test', 1, '2025-10-12 09:40:59', '2025-10-12 09:41:05');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (10, 'INU', 'Incomplete Uniform', 0, '2026-02-12 14:27:06', '2026-02-12 14:27:06');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (11, 'NH', 'No Hairnet', 0, '2026-02-12 14:27:58', '2026-02-12 14:27:58');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (12, 'WS', 'Wrong Socks', 0, '2026-02-12 14:28:16', '2026-02-12 14:28:16');
INSERT INTO `violations` (`id`, `violation`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES (13, 'NF', 'No Flashlight', 0, '2026-02-12 14:28:28', '2026-02-12 14:28:28');


