// Medical calculations and assessments
function calculateAllVitals() {
    calculateBMI();
    calculateTemperatureStatus();
    calculateBloodPressureStatus();
    calculatePulseStatus();
    calculateRespirationStatus();
    generateVitalSummary();
}

function calculateBMI() {
    const weightEl = document.getElementById('weight');
    const heightEl = document.getElementById('height');
    const bmiDisplay = document.getElementById('bmi_display');
    
    if (!weightEl || !heightEl || !bmiDisplay) return;
    
    const weight = parseFloat(weightEl.value);
    const height = parseFloat(heightEl.value);
    
    if (weight && height && weight > 0 && height > 0) {
        const heightInMeters = height / 100;
        const bmi = weight / (heightInMeters * heightInMeters);
        
        let category = '';
        let categoryColor = '';
        
        if (bmi < 18.5) {
            category = 'Underweight';
            categoryColor = '#17a2b8';
        } else if (bmi >= 18.5 && bmi < 25) {
            category = 'Normal weight';
            categoryColor = '#28a745';
        } else if (bmi >= 25 && bmi < 30) {
            category = 'Overweight';
            categoryColor = '#ffc107';
        } else {
            category = 'Obese';
            categoryColor = '#dc3545';
        }
        
        bmiDisplay.innerHTML = `<strong>BMI:</strong> <span style="color: ${categoryColor}; font-weight: bold;">${bmi.toFixed(1)} - ${category}</span>`;
    } else {
        bmiDisplay.innerHTML = '<strong>BMI:</strong> <span class="text-muted">Enter weight and height</span>';
    }
}

function calculateTemperatureStatus() {
    const tempEl = document.getElementById('temperature');
    const tempStatus = document.getElementById('temp_status');
    
    if (!tempEl || !tempStatus) return;
    
    const temp = parseFloat(tempEl.value);
    
    if (temp && temp > 0) {
        let status = '';
        let color = '';
        
        if (temp < 36.1) {
            status = 'Hypothermia';
            color = '#17a2b8';
        } else if (temp >= 36.1 && temp <= 37.2) {
            status = 'Normal';
            color = '#28a745';
        } else if (temp > 37.2 && temp <= 38.0) {
            status = 'Low-grade fever';
            color = '#ffc107';
        } else if (temp > 38.0 && temp <= 39.0) {
            status = 'Moderate fever';
            color = '#fd7e14';
        } else {
            status = 'High fever';
            color = '#dc3545';
        }
        
        tempStatus.innerHTML = `<strong>Status:</strong> <span style="color: ${color}; font-weight: bold;">${temp.toFixed(1)}°C - ${status}</span>`;
    } else {
        tempStatus.innerHTML = '<strong>Status:</strong> <span class="text-muted">Enter temperature</span>';
    }
}

function calculateBloodPressureStatus() {
    const bpEl = document.getElementById('blood_pressure');
    const bpStatus = document.getElementById('bp_status');
    
    if (!bpEl || !bpStatus) return;
    
    const bp = bpEl.value;
    
    if (bp && bp.includes('/')) {
        const [systolic, diastolic] = bp.split('/').map(num => parseInt(num.trim()));
        
        if (systolic && diastolic) {
            let status = '';
            let color = '';
            
            if (systolic < 90 || diastolic < 60) {
                status = 'Hypotension (Low)';
                color = '#17a2b8';
            } else if (systolic < 120 && diastolic < 80) {
                status = 'Normal';
                color = '#28a745';
            } else if (systolic < 130 && diastolic < 80) {
                status = 'Elevated';
                color = '#ffc107';
            } else if (systolic < 140 || diastolic < 90) {
                status = 'Stage 1 Hypertension';
                color = '#fd7e14';
            } else if (systolic < 180 || diastolic < 120) {
                status = 'Stage 2 Hypertension';
                color = '#dc3545';
            } else {
                status = 'Hypertensive Crisis';
                color = '#6f42c1';
            }
            
            bpStatus.innerHTML = `<strong>Status:</strong> <span style="color: ${color}; font-weight: bold;">${bp} - ${status}</span>`;
        }
    } else {
        bpStatus.innerHTML = '<strong>Status:</strong> <span class="text-muted">Enter blood pressure</span>';
    }
}

function calculatePulseStatus() {
    const pulseEl = document.getElementById('pulse');
    const pulseStatus = document.getElementById('pulse_status');
    
    if (!pulseEl || !pulseStatus) return;
    
    const pulse = parseInt(pulseEl.value);
    
    if (pulse && pulse > 0) {
        let status = '';
        let color = '';
        
        if (pulse < 60) {
            status = 'Bradycardia (Slow)';
            color = '#17a2b8';
        } else if (pulse >= 60 && pulse <= 100) {
            status = 'Normal';
            color = '#28a745';
        } else if (pulse > 100 && pulse <= 120) {
            status = 'Mild Tachycardia';
            color = '#ffc107';
        } else {
            status = 'Tachycardia (Fast)';
            color = '#dc3545';
        }
        
        pulseStatus.innerHTML = `<strong>Pulse:</strong> <span style="color: ${color}; font-weight: bold;">${pulse} bpm - ${status}</span>`;
    } else {
        pulseStatus.innerHTML = '<strong>Pulse:</strong> <span class="text-muted">Enter pulse rate</span>';
    }
}

function calculateRespirationStatus() {
    const respEl = document.getElementById('respiration');
    const respStatus = document.getElementById('resp_status');
    
    if (!respEl || !respStatus) return;
    
    const resp = parseInt(respEl.value);
    
    if (resp && resp > 0) {
        let status = '';
        let color = '';
        
        if (resp < 12) {
            status = 'Bradypnea (Slow)';
            color = '#17a2b8';
        } else if (resp >= 12 && resp <= 20) {
            status = 'Normal';
            color = '#28a745';
        } else if (resp > 20 && resp <= 25) {
            status = 'Mild Tachypnea';
            color = '#ffc107';
        } else {
            status = 'Tachypnea (Fast)';
            color = '#dc3545';
        }
        
        respStatus.innerHTML = `<strong>Rate:</strong> <span style="color: ${color}; font-weight: bold;">${resp} rpm - ${status}</span>`;
    } else {
        respStatus.innerHTML = '<strong>Rate:</strong> <span class="text-muted">Enter respiration rate</span>';
    }
}

function generateVitalSummary() {
    const vitalSummary = document.getElementById('vital_summary');
    const assessmentCard = document.getElementById('assessment-card');
    const ageEl = document.getElementById('age');
    
    if (!vitalSummary || !assessmentCard) return;
    
    const age = ageEl ? parseInt(ageEl.value) : null;
    
    // Get all status values with null checks
    const bmiEl = document.getElementById('bmi_display');
    const tempEl = document.getElementById('temp_status');
    const bpEl = document.getElementById('bp_status');
    const pulseEl = document.getElementById('pulse_status');
    const respEl = document.getElementById('resp_status');
    
    const bmi = bmiEl ? bmiEl.innerHTML : '';
    const temp = tempEl ? tempEl.innerHTML : '';
    const bp = bpEl ? bpEl.innerHTML : '';
    const pulse = pulseEl ? pulseEl.innerHTML : '';
    const resp = respEl ? respEl.innerHTML : '';
    
    // Show assessment card if any vital signs are entered
    const weightInputEl = document.getElementById('weight');
    const heightInputEl = document.getElementById('height');
    const tempInputEl = document.getElementById('temperature');
    const bpInputEl = document.getElementById('blood_pressure');
    const pulseInputEl = document.getElementById('pulse');
    const respInputEl = document.getElementById('respiration');
    
    const hasVitals = age || 
                     (weightInputEl && weightInputEl.value) || 
                     (heightInputEl && heightInputEl.value) || 
                     (tempInputEl && tempInputEl.value) || 
                     (bpInputEl && bpInputEl.value) || 
                     (pulseInputEl && pulseInputEl.value) || 
                     (respInputEl && respInputEl.value);
    
    if (hasVitals) {
        assessmentCard.style.display = 'block';
        
        if (age && (bmi || temp || bp || pulse || resp)) {
            let summary = `Patient Assessment (Age: ${age}): `;
            let concerns = [];
            let normal = [];
            
            // Check each vital sign
            if (bmi && !bmi.includes('Normal weight')) concerns.push('BMI abnormal');
            else if (bmi && bmi.includes('Normal weight')) normal.push('BMI normal');
            
            if (temp && !temp.includes('Normal')) concerns.push('Temperature abnormal');
            else if (temp && temp.includes('Normal')) normal.push('Temperature normal');
            
            if (bp && !bp.includes('Normal')) concerns.push('Blood pressure abnormal');
            else if (bp && bp.includes('Normal')) normal.push('Blood pressure normal');
            
            if (pulse && !pulse.includes('Normal')) concerns.push('Heart rate abnormal');
            else if (pulse && pulse.includes('Normal')) normal.push('Heart rate normal');
            
            if (resp && !resp.includes('Normal')) concerns.push('Respiratory rate abnormal');
            else if (resp && resp.includes('Normal')) normal.push('Respiratory rate normal');
            
            if (concerns.length > 0) {
                summary += `⚠️ ATTENTION NEEDED: ${concerns.join(', ')}. `;
                vitalSummary.style.color = '#dc3545';
            } else {
                summary += `✅ All vital signs within normal ranges. `;
                vitalSummary.style.color = '#28a745';
            }
            
            if (normal.length > 0) {
                summary += `Normal: ${normal.join(', ')}.`;
            }
            
            vitalSummary.innerHTML = summary;
            vitalSummary.style.fontWeight = 'bold';
        } else {
            vitalSummary.innerHTML = '<span class="text-muted">Complete all vital signs for assessment</span>';
            vitalSummary.style.color = '';
            vitalSummary.style.fontWeight = '';
        }
    } else {
        assessmentCard.style.display = 'none';
    }
}

// Blood pressure auto-formatting function
function formatBloodPressure(input) {
    let value = input.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
    
    if (value.length >= 2 && value.length <= 3) {
        // Auto-add slash after systolic pressure (2-3 digits)
        if (!input.value.includes('/')) {
            input.value = value + '/';
            // Move cursor to end
            setTimeout(() => {
                input.setSelectionRange(input.value.length, input.value.length);
            }, 0);
        }
    } else if (value.length > 3) {
        // Format as systolic/diastolic
        const systolic = value.substring(0, 3);
        const diastolic = value.substring(3, 5); // Limit diastolic to 2 digits
        input.value = systolic + '/' + diastolic;
    } else if (value.length > 0) {
        input.value = value;
    }
}

// Handle backspace and delete keys for blood pressure
function handleBloodPressureKeydown(e) {
    const input = e.target;
    const cursorPos = input.selectionStart;
    const value = input.value;
    
    // Handle backspace when cursor is right after the slash
    if (e.key === 'Backspace' && cursorPos > 0 && value[cursorPos - 1] === '/') {
        e.preventDefault();
        // Remove the slash and the digit before it
        input.value = value.substring(0, cursorPos - 2) + value.substring(cursorPos);
        input.setSelectionRange(cursorPos - 2, cursorPos - 2);
    }
    // Handle delete when cursor is right before the slash
    else if (e.key === 'Delete' && cursorPos < value.length && value[cursorPos] === '/') {
        e.preventDefault();
        // Remove the slash and the digit after it
        input.value = value.substring(0, cursorPos) + value.substring(cursorPos + 2);
        input.setSelectionRange(cursorPos, cursorPos);
    }
}

// Add event listeners to all vital sign inputs
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['weight', 'height', 'age', 'temperature', 'blood_pressure', 'pulse', 'respiration'];
    
    inputs.forEach(inputId => {
        const element = document.getElementById(inputId);
        if (element) {
            if (inputId === 'blood_pressure') {
                // Special handling for blood pressure
                element.addEventListener('input', function(e) {
                    formatBloodPressure(e.target);
                    calculateAllVitals();
                });
                element.addEventListener('keydown', handleBloodPressureKeydown);
                element.addEventListener('blur', calculateAllVitals);
            } else {
                element.addEventListener('input', calculateAllVitals);
                element.addEventListener('blur', calculateAllVitals);
            }
        }
    });
    
    // Calculate on page load with a small delay to ensure all elements are loaded
    setTimeout(calculateAllVitals, 100);
});
