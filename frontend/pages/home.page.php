<?php
$aCategories =  $items->getFilters('categories');
$aDifficulties =  $items->getFilters('difficulties');
$aTypes =  $items->getFilters('types');
$sGeneratedApiUrl = $_SERVER['HTTP_HOST'] . '/api/v1';

if ($_POST) {
  $sGeneratedApiUrl = $_SERVER['HTTP_HOST'] . '/api/v1?';
  foreach ($_POST as $name => $val) {
    if ($val) {
      $sGeneratedApiUrl .= htmlspecialchars($name . '=' . $val) . "&";
    }
  }
  $sGeneratedApiUrl = rtrim($sGeneratedApiUrl, '&');
}
?>

<div class="row justify-content-md-center">
  <div class="col col-lg-6">
    <h2 class="">API URL generator</h2>
    <div class="alert alert-success text-center">
      <?php echo $sGeneratedApiUrl; ?>
    </div>

    <form action="/" method="post">
      <div class="mb-3">
        <label for="amount" class="form-label">Number of Questions:</label>
        <input type="number" name="amount" class="form-control" min="1" max="50" value="10">
      </div>
      <div class="mb-3">
        <label for="category">Select Category: </label>
        <select name="category" class="form-control">
          <option selected value>Any Category</option>
          <?php
          foreach ($aCategories as $category) {
            echo '<option value="' . $category['category_id'] . '">' . $category['category_title'] . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="difficulty">Select Difficulty: </label>
        <select name="difficulty" class="form-control">
          <option selected value>Any Difficulty</option>
          <?php
          foreach ($aDifficulties as $difficulty) {
            echo '<option value="' . $difficulty['difficulty_id'] . '">' . $difficulty['difficulty_title'] . '</option>';
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="type">Select Type: </label>
        <select name="type" class="form-control">
          <option selected value>Any Type</option>
          <?php
          foreach ($aTypes as $type) {
            echo '<option value="' . $type['type_id'] . '">' . $type['type_title'] . '</option>';
          }
          ?>
        </select>
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" name="random" type="checkbox" value=true>
        <label class="form-check-label" for="random">
          Get random questions
        </label>
      </div>

      <div class="d-grid gap-2">
        <button class="btn btn-primary" type="submit">Generate API URL</button>
      </div>
    </form>
  </div>
</div>