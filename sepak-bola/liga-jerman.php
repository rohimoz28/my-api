<?php require '../layout/header.php' ?>
<?php

$urlStandings = 'https://api-football-standings.azharimm.site/leagues/ger.1/standings?season=2021&sort=asc';
$getStandingsJSON = file_get_contents($urlStandings);
$standingsJSON = json_decode($getStandingsJSON, 1);
$standings = $standingsJSON['data']['standings'];


/* var_dump($standings['team']); */
/* var_dump($standings[1]['team']); */
/* die; */


?>
<div class="row">
  <div class="col-md-10">
    <h1 class="my-3">Klasemen Liga Jerman</h1>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Klub</th>
          <th scope="col">MN</th>
          <th scope="col">M</th>
          <th scope="col">K</th>
          <th scope="col">S</th>
          <th scope="col">Poin</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($standings as $no => $stand) : ?>
          <tr>
            <th scope="row"><?= $no + 1 ?></th>
            <td><?= $stand['team']['name'] ?></td>
            <td><?= $stand['stats'][3]['value'] ?></td>
            <td><?= $stand['stats'][0]['value'] ?></td>
            <td><?= $stand['stats'][1]['value'] ?></td>
            <td><?= $stand['stats'][2]['value'] ?></td>
            <td><?= $stand['stats'][6]['value'] ?></td>
          </tr>
          <?php $no++ ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php require '../layout/footer.php' ?>
