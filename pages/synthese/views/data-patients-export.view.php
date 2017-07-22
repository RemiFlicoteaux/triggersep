<style>
  #header{
    display: none;
  }
  .separator br{
    display: none;
  }
  #footer{
    display: none;
  }
</style>
<div class="row" id='file_reader'>
  <form enctype="multipart/form-data" action="./?p=triggersep-data-patients-popup" method="post" id="reader-form">
     <div class="params">
      <div class="row">
        <div class="col-md-12 one">
          <label for="etude">Format Export</label>
          <select  id="select_format" name="format" class="form-control">
          <option value="">Sélectionner le format d'export</option>
            <option  value="Export_ligne" >
              Export en ligne
              </option>
            <option  value="Export_colone" >
              Export en colone
              </option>
            </select>
          </div>
          <div>
            <p style="text-align: center;">
            <button type="submit" style="text-align: center;" value="Export" name="Export" class="btn btn-success">Exporter</button>
            </p>
          </div>
        </div>
    </div>
  </form>
</div>
