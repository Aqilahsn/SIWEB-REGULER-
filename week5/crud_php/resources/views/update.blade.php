<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #e8e8e8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            background: white;
            padding: 35px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
            width: 100%;
            max-width: 380px;
        }
        
        h1 {
            font-size: 18px;
            font-weight: normal;
            margin-bottom: 25px;
            color: #333;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 18px;
        }
        
        label {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
            color: #333;
            font-weight: normal;
        }
        
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 13px;
            font-family: Arial, sans-serif;
            background-color: white;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #4169e1;
        }
        
        input::placeholder {
            color: #999;
        }
        
        .error-message {
            color: #d32f2f;
            font-size: 12px;
            margin-top: 4px;
            display: block;
            font-weight: normal;
        }
        
        .input-error {
            border-color: #d32f2f !important;
            background-color: #fff !important;
        }
        
        .input-error::placeholder {
            color: #d32f2f;
        }
        
        .alert {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 3px;
            font-size: 12px;
            border: 1px solid;
        }
        
        .alert-danger {
            background-color: #ffebee;
            border-color: #ef5350;
            color: #d32f2f;
        }
        
        .alert-success {
            background-color: #e8f5e9;
            border-color: #66bb6a;
            color: #2e7d32;
        }
        
        .button-group {
            margin-top: 20px;
        }
        
        button {
            border: none;
            border-radius: 3px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: Arial, sans-serif;
        }
        
        .btn-update {
            width: 100%;
            padding: 11px;
            background-color: #4169e1;
            color: white;
            margin-bottom: 10px;
        }
        
        .btn-update:hover {
            background-color: #315acb;
        }
        
        .bottom-buttons {
            display: flex;
            gap: 8px;
        }
        
        .btn-create {
            flex: 1;
            padding: 11px;
            background-color: #333;
            color: white;
        }
        
        .btn-create:hover {
            background-color: #555;
        }
        
        .btn-read {
            flex: 1;
            padding: 11px;
            background-color: #999;
            color: white;
        }
        
        .btn-read:hover {
            background-color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update User</h1>
        
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form method="POST" action="/update/{{ $data->id }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="username">Name:</label>
                <input type="text" id="username" name="username" placeholder="Your name" 
                       value="{{ $data->username }}"
                       class="@error('username') input-error @enderror">
                @error('username')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your email" 
                       value="{{ $data->email }}"
                       class="@error('email') input-error @enderror">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn-update">Update</button>
                <div class="bottom-buttons">
                    <button type="button" class="btn-create" onclick="window.location.href='/create'">CREATE</button>
                    <button type="button" class="btn-read" onclick="window.location.href='/'">READ</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
</body>
</html>
