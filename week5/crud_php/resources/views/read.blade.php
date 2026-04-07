<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Data</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #e8e8e8;
            padding: 20px;
        }
        
        .container {
            background: white;
            padding: 35px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        
        h1 {
            font-size: 18px;
            font-weight: normal;
            margin-bottom: 25px;
            color: #333;
            text-align: center;
        }
        
        .data-list {
            margin-bottom: 20px;
        }
        
        .data-item {
            background: #f5f5f5;
            padding: 14px;
            margin-bottom: 12px;
            border-radius: 3px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 3px solid #4169e1;
        }
        
        .data-info {
            flex: 1;
        }
        
        .data-name {
            font-weight: 600;
            color: #333;
            font-size: 13px;
        }
        
        .data-email {
            color: #666;
            font-size: 12px;
            margin-top: 2px;
        }
        
        .data-actions {
            display: flex;
            gap: 6px;
            margin-left: 12px;
        }
        
        .btn-edit,
        .btn-delete {
            padding: 6px 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s;
            font-family: Arial, sans-serif;
        }
        
        .btn-edit {
            background-color: #4caf50;
            color: white;
        }
        
        .btn-edit:hover {
            background-color: #45a049;
        }
        
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
        
        .btn-delete:hover {
            background-color: #da190b;
        }
        
        .empty-message {
            text-align: center;
            color: #999;
            padding: 30px 20px;
            font-size: 13px;
        }
        
        .bottom-buttons {
            display: flex;
            gap: 8px;
        }
        
        button {
            flex: 1;
            padding: 11px;
            border: none;
            border-radius: 3px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: Arial, sans-serif;
        }
        
        .btn-create {
            background-color: #333;
            color: white;
        }
        
        .btn-create:hover {
            background-color: #555;
        }
        
        .btn-read {
            background-color: #999;
            color: white;
        }
        
        .btn-read:hover {
            background-color: #777;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .modal-content {
            background-color: #464646;
            margin: 30% auto;
            padding: 30px;
            border-radius: 4px;
            width: 90%;
            max-width: 320px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .modal-icon {
            font-size: 18px;
            margin-bottom: 15px;
            color: #666;
        }
        
        .modal-content p {
            color: #fff;
            margin-bottom: 25px;
            font-size: 13px;
        }
        
        .modal-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        
        .modal-btn {
            padding: 8px 18px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-weight: 600;
            font-size: 12px;
            transition: all 0.2s;
            font-family: Arial, sans-serif;
        }
        
        .modal-btn-cancel {
            background-color: #666;
            color: white;
            min-width: 80px;
        }
        
        .modal-btn-cancel:hover {
            background-color: #777;
        }
        
        .modal-btn-confirm {
            background-color: #00bcd4;
            color: white;
            min-width: 50px;
        }
        
        .modal-btn-confirm:hover {
            background-color: #0097a7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Read Data</h1>
        
        <div class="data-list">
            @if($data->count() > 0)
                @foreach($data as $d)
                    <div class="data-item">
                        <div class="data-info">
                            <div class="data-name">{{ $d->username }}</div>
                            <div class="data-email">{{ $d->email }}</div>
                        </div>
                        <div class="data-actions">
                            <button class="btn-edit" onclick="window.location.href='/edit/{{ $d->id }}'">Edit</button>
                            <button class="btn-delete" onclick="confirmDelete({{ $d->id }})">Delete</button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-message">
                    No data available. Click CREATE to add new data.
                </div>
            @endif
        </div>
        
        <div class="bottom-buttons">
            <button class="btn-create" onclick="window.location.href='/create'">CREATE</button>
            <button class="btn-read" onclick="window.location.href='/'">READ</button>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">⊗ localhost</div>
            <p>Are you sure?</p>
            <div class="modal-buttons">
                <button class="modal-btn modal-btn-cancel" onclick="closeModal()">Cancel</button>
                <button class="modal-btn modal-btn-confirm" onclick="performDelete()">OK</button>
            </div>
        </div>
    </div>
    
    <script>
        let deleteId = null;
        
        function confirmDelete(id) {
            deleteId = id;
            document.getElementById('deleteModal').style.display = 'block';
        }
        
        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
            deleteId = null;
        }
        
        function performDelete() {
            if (deleteId) {
                window.location.href = '/delete/' + deleteId;
            }
        }
        
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
