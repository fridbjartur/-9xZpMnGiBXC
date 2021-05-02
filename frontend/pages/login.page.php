<?php
$errorMessage;
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $errorMessage = $users->login($_POST['email'], $_POST['password']);
}
?>

<main class="form-signin">
    <form action="/login" method="post">
        <img class="mb-4" src="/frontend/assets/images/logo.svg" alt="" width="72">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" autocomplete="off" required>
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" autocomplete="off" value="kG!JBb2!" required>
            <label for="floatingPassword">Password</label>
        </div>
        <?php
        if (!empty($errorMessage)) {
            echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
        }
        ?>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
</main>