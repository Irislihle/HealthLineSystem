<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="datetime-local"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 150px;
            resize: vertical;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
        }
        .checkbox-group input {
            width: auto;
            margin-right: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create New Announcement</h1>
        <form action="process_announcement.php" method="post">
            <div class="form-group">
                <label for="title">Title*</label>
                <input type="text" id="title" name="title" required>
            </div>
            
            <div class="form-group">
                <label for="content">Content*</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="author">Author*</label>
                <input type="text" id="author" name="author" required>
            </div>
            
            <div class="form-group">
                <label for="publish_date">Publish Date</label>
                <input type="datetime-local" id="publish_date" name="publish_date">
            </div>
            
            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="datetime-local" id="expiry_date" name="expiry_date">
            </div>
            
            <div class="form-group checkbox-group">
                <input type="checkbox" id="is_active" name="is_active" value="1" checked>
                <label for="is_active">Active Announcement</label>
            </div>
            
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category">
                    <option value="">Select a category</option>
                    <option value="general">General</option>
                    <option value="news">News</option>
                    <option value="event">Event</option>
                    <option value="update">Update</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="priority">Priority</label>
                <select id="priority" name="priority">
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                    <option value="high">High</option>
                </select>
            </div>
            
            <button type="submit">Create Announcement</button>
        </form>
    </div>
</body>
</html>