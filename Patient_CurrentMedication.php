
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medication Prescription Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 105, 204, 0.1);
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #d1e7ff;
            background-color:rgb(253, 255, 245);
        }
        .form-header {
            text-align: center;
            margin-bottom: 25px;
            color: #0066cc;
            padding-bottom: 15px;
            border-bottom: 2px solid #e1f0ff;
        }
        .form-header h2 {
            margin: 0;
            font-size: 28px;
        }
        .form-header p {
            margin: 5px 0 0;
            color: #6699cc;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #336699;
        }
        .required:after {
            content: " *";
            color: #ff3333;
        }
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cce0ff;
            border-radius: 6px;
            background-color: #f9fbff;
            font-size: 15px;
            transition: all 0.3s;
        }
        input[type="text"]:focus,
        input[type="date"]:focus,
        select:focus,
        textarea:focus {
            border-color: #99c2ff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 105, 204, 0.1);
            background-color: #ffffff;
        }
        textarea {
            min-height: 80px;
            resize: vertical;
        }
        .btn-submit {
            background: linear-gradient(to right, #0066cc, #0099cc);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            display: block;
            width: 100%;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background: linear-gradient(to right, #0055aa, #0088bb);
            box-shadow: 0 2px 10px rgba(0, 105, 204, 0.2);
        }
        .checkbox-group {
            display: flex;
            align-items: center;
        }
        .checkbox-group input {
            margin-right: 10px;
        }
        .form-section {
            background-color:rgb(253, 255, 245);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #99c2ff;
        }
        .form-section h3 {
            margin-top: 0;
            color: #0066cc;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Medication Prescription Form</h2>
            <p>Please complete all required fields</p>
        </div>
        
        <form id="medicationForm" action="addMed.php" method="POST">
            <!-- Patient Information Section -->
            <div class="form-section">
                <h3>Patient Information</h3>
                <div class="form-group">
                    <label for="patient_id" class="required">Patient ID</label>
                    <input type="text" id="patient_id" name="patient_id" required 
                           placeholder="Enter 13-digit patient ID">
                </div>
            </div>
            
            <!-- Medication Details Section -->
            <div class="form-section">
                <h3>Medication Details</h3>
                <div class="form-group">
                    <label for="medication_name" class="required">Medication Name</label>
                    <input type="text" id="medication_name" name="medication_name" required
                           placeholder="e.g., Amoxicillin, Lisinopril">
                </div>
                
                <div class="form-group">
                    <label for="dosage" class="required">Dosage</label>
                    <input type="text" id="dosage" name="dosage" required
                           placeholder="e.g., 500mg, 10mg/5mL">
                </div>
                
                <div class="form-group">
                    <label for="frequency" class="required">Frequency</label>
                    <input type="text" id="frequency" name="frequency" required
                           placeholder="e.g., Twice daily, Every 6 hours">
                </div>
                
                <div class="form-group">
                    <label for="route">Route of Administration</label>
                    <select id="route" name="route">
                        <option value="Oral" selected>Oral</option>
                        <option value="Topical">Topical</option>
                        <option value="Injection">Injection</option>
                        <option value="Inhalation">Inhalation</option>
                        <option value="Sublingual">Sublingual</option>
                        <option value="Rectal">Rectal</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="purpose">Purpose/Indication</label>
                    <input type="text" id="purpose" name="purpose"
                           placeholder="e.g., Hypertension, Infection">
                </div>
            </div>
            
            <!-- Prescription Information Section -->
            <div class="form-section">
                <h3>Prescription Information</h3>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date">
                </div>
                
                <div class="form-group">
                    <label for="prescribed_by">Prescribed By</label>
                    <input type="text" id="prescribed_by" name="prescribed_by"
                           placeholder="Dr. Smith">
                </div>
                
                <div class="form-group">
                    <label for="last_refill_date">Last Refill Date</label>
                    <input type="date" id="last_refill_date" name="last_refill_date">
                </div>
                
                <div class="form-group">
                    <label for="next_refill_date">Next Refill Date</label>
                    <input type="date" id="next_refill_date" name="next_refill_date">
                </div>
            </div>
            
            <!-- Additional Information Section -->
            <div class="form-section">
                <h3>Additional Information</h3>
                <div class="form-group">
                    <label for="notes">Special Instructions/Notes</label>
                    <textarea id="notes" name="notes" placeholder="Any special administration instructions..."></textarea>
                </div>
                
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="is_active"  name="is_active" checked>
                    <label for="is_active" style="display: inline; font-weight: normal;">This is an active prescription</label>
                </div>
            </div>
            
            <button type="submit" class="btn-submit">Save Prescription</button>
        </form>
    </div>

    <script>
        document.getElementById('medicationForm').addEventListener('submit', function(e) {
            const requiredFields = document.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#ff6666';
                    field.style.backgroundColor = '#fff0f0';
                    isValid = false;
                } else {
                    field.style.borderColor = '#cce0ff';
                    field.style.backgroundColor = '#f9fbff';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please complete all required fields marked with *.');
            }
        });

        // Reset field styles when user starts typing
        document.querySelectorAll('input, textarea').forEach(field => {
            field.addEventListener('input', function() {
                if (this.hasAttribute('required')) {
                    this.style.borderColor = '#cce0ff';
                    this.style.backgroundColor = '#f9fbff';
                }
            });
        });
    </script>
</body>
</html>
