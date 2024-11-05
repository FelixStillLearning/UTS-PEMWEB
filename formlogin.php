<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="tampilanlogin.css" rel="stylesheet">
</head>
<body>
    <div class="container d-md-flex align-items-center justify-content-between mt-5">
        <!-- Image Box -->
        <div class="box-1 mt-md-0 mt-5">
            <img src="gudang.jpeg" alt="gambar gudang">
        </div>

        <!-- Login Form & Social Login Options -->
        <div class="box-2 d-flex flex-column h-100">
            <div class="form-container">
                <?php
                session_start();
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }
                ?>
                <p class="form-title">Login</p>
                <!-- Form Login -->
                <form method="POST" action="ceklogin.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukan username anda" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukan password anda" name="password" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-outline-success">Login</button>
                        <button type="button" class="btn btn-warning">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2mA0xHpPZRDfQA6zgBR6aeMP9yXBp3Ffl8W9Ll/O1yEQQou59mF9/j9exx1" crossorigin="anonymous"></script>
</body>
</html>
