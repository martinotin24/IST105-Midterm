<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Calculator</title>
</head>
<body>
    <h2>Math Calculator</h2>
    <form action="process_math.php" method="post">
        <label for="num1">Number 1:</label>
        <input type="number" name="num1" required><br>

        <label for="num2">Number 2:</label>
        <input type="number" name="num2" required><br>

        <label for="operation">Select Operation:</label>
        <select name="operation" required>
            <option value="add">Addition</option>
            <option value="sub">Subtraction</option>
            <option value="mul">Multiplication</option>
            <option value="div">Division</option>
        </select><br>

        <input type="submit" value="Calculate">
    </form>
</body>
</html>
