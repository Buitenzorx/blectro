
<style>
        .toggle-container {
            position: relative;
        }

        .toggle-checkbox {
            display: none;
        }

        .toggle-label {
            display: block;
            width: 60px;
            height: 30px;
            background-color: #ccc;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .toggle-label:before {
            content: '';
            display: block;
            width: 26px;
            height: 26px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: transform 0.3s;
        }

        .toggle-checkbox:checked + .toggle-label {
            background-color: #4CAF50;
        }

        .toggle-checkbox:checked + .toggle-label:before {
            transform: translateX(30px);
        }
    </style>
    <div class="toggle-container">
        <input type="checkbox" id="toggle" class="toggle-checkbox">
        <label for="toggle" class="toggle-label"></label>
    </div>
