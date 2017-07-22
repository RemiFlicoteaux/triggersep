<div id="infos-patient">
  <div class="col-md-5">
    <table>
      <tbody>
        <tr>
          <td>
            <b>NIP:</b><?= $infos_sejour_date[0]['NIP']; ?>
            <b>NDA:</b><?= $infos_sejour_date[0]['NDA']; ?>
          </td>
        </tr>
        <tr>
          <td>
            <b><?= $infos_sejour_date[0]['NOM'] . ' ' . $infos_sejour_date[0]['PRENOM']; ?>:</b>
            Né(e) le <?= $infos_sejour_date[0]['DANAIS']; ?> (<?= $infos_sejour_date[0]['SEXE'] == 1 ? 'M' : 'F'; ?>)
          </td>
        </tr>
        <tr>
          <td>
            <b>Séjour du : </b><?= $infos_sejour_date[0]['DES']; ?> au <?= $infos_sejour_date[0]['DSS']; ?> - <?= $infos_sejour_date[0]['DUSEJ']; ?> jour(s) 
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-7">
    <table>
      <tbody>
        <tr>
          <td>
            <b>Eléments de Groupage</b>
          </td>
        </tr>
        <tr>
          <td>
            <?= $infos_sejour_date[0]['GHM']; ?> - <?= $infos_sejour_libelle_ghm; ?> 
          </td>
        </tr>
        <tr>
          <td>
            GHS : <?= $infos_sejour_date[0]['GHS']; ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>