<div class="modal fade" id="modalUpload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalUpload" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <form method="POST" enctype="multipart/form-data" x-data="fileUploader()">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalUpload">Pilih File Attachment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-4">
            <label for="uploadFiles" class="form-label">Upload Attachment</label>
            <input name="files[]" type="file" x-on:input="uploadFile()" id="uploadFiles" class="form-control form-control-sm" multiple>
          </div>                      

          <hr>
          
          <div class="my-4">
            <h5>File yang anda upload:</h5>
            <div class="d-flex flex-column" id="listFile">

            </div>          
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" x-on:click="submitFiles()" data-bs-dismiss="modal">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script>
  function fileUploader(){
    return {
      uploadFile() {
        let notyf = new Notyf();
        let files = document.getElementById("uploadFiles").files;

        if (files.length > 0){
          let data = new FormData();
          let request = new XMLHttpRequest();

          for(var i = 0; i < files.length; ++i){
            data.append('files[]', files[i]);
          }
          
          request.open("POST", "/ajax/upload_file.php", true);
          request.setRequestHeader('Cache-Control', 'no-cache');

          request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {              
              notyf.success('File anda berhasil diupload!');              
              fileUploader().getFiles();
            }
          };
                    
          request.send(data);                      
        } else{
          notyf.error("Tolong pilih file untuk diupload");
        }
      },
      submitFiles(){
        let checkboxs = document.getElementsByClassName('checkbox-file');
        let fileNames = document.getElementsByClassName('checkbox-label');
        let attIds = '';
        let selectedFiles = '';

        for(let i = 0; i < checkboxs.length; i++){
          if(checkboxs[i].checked){
            attIds += checkboxs[i].value + ',';
            selectedFiles += `<div class="mb-1">${ fileNames[i].innerHTML }</div>`
          }          
        }

        if(attIds != ''){
          let ids = attIds.slice(0, -1);

          document.getElementById('attachment').value = ids;
          document.getElementById('selectedFiles').innerHTML = selectedFiles;
          document.getElementById('fileLength').innerHTML = 'Terpilih ' + ids.split(',').length + ' File'
        }        
      },
      getFiles(){
        let xmlhttp = null;

        if (window.XMLHttpRequest){
          xmlhttp = new XMLHttpRequest();
        }
        else{
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function(){
          if (xmlhttp.readyState == 4){
            document.getElementById("listFile").innerHTML = xmlhttp.responseText;
          }          
        }

        xmlhttp.open("GET", "/ajax/list_file.php", true);
        xmlhttp.send();
      }
    }
  }  

  window.onload = fileUploader().getFiles();
</script>