<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/main.css">
    </head>
    <body>
        <div>
            <p><strong>Note: Show status follow background color</strong></p>
            <p>1. Planning: yellow</p>
            <p>2. Doing: red</p>
            <p>3. Green: green</p>
            <br>
            <h2>Edit Task</h2>
            <p>You only change start date if status is Planning (Background yellow)</p>
            <p>You can not change the start date smaller than the current date //continue...</p>
            <p>You only change end date if status is Planning and Doing (Background yellow and red)</p>
            <p>You only change status is Planning to Doing or Complete and staus Doing to Complete</p>
            <p>You can't change status Complete</p>
            <br>
            <h2>Add Task</h2>
            <p>Click day if you want to add task</p>

        </div>
        <div id="calendar" class="container" style="width: 800px; height: auto"></div>
        <script src='/bundle.js' ></script>

    </body>
</html>


