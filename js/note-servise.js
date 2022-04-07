var NoteService = {
  init: function(){
      $('#addNoteForm').validate({
       submitHandler: function(form) {

           var note = Object.fromEntries((new FormData(form)).entries());
           NoteService.add(note);

         }
      });
      NoteService.list();
   },

  list: function(){
      $.get( "rest/notes", function( data ) {
        $("#note-list").html("");
        var html = "" ;

        for(let i = 0; i < data.length; i++){
          html += `
          <div class="col-lg-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top"  alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">`+ data[i].description + `</h5>
                <p class="card-text">`+ data[i].created + `:Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <button type="button" class="btn btn-primary note-button" onclick="NoteService.get(`+ data[i].id+ `)">Edit</button>
                <button type="button" class="btn btn-danger"onclick="NoteService.delete(`+ data[i].id+ `)">Delete</button>
              </div>
             </div>
            </div>
          </div>
          `;

        }
        $("#note-list").html(html);

      });

    },

  get: function(id){
      $('.note-button').attr('disabled', true);
      $.get('rest/notes/'+id,function(data){
        $("#description").val(data.description);
        $("#id").val(data.id);
        $("#created").val(data.created);
        $("#exampleModal").modal("show");
        $('.note-button').attr('disabled', false);
      })

    },

  add: function(note){
        $.ajax({
        url: 'rest/notes/' ,
        type: 'POST',
        data: JSON.stringify(note),
        contentType: "application/json",
        dataType: "json",
        success: function(result) {
            $("#note-list").html('<div class="spinner-border text-primary" role="status"> <span class="sr-only"></span>  </div>');
            NoteService.list();
            $("#addNoteModal").modal("hide");
        }
      });

    },

  update: function(){
        $('.save-note-button').attr('disabled', true);
        var note =  {}
        note.description = $('#description').val();
        note.created = $('#created').val();
        $.ajax({
        url: 'rest/notes/' + $('#id').val(),
        type: 'PUT',
        data: JSON.stringify(note),
        contentType: "application/json",
        dataType: "json",
        success: function(result) {
            $("#exampleModal").modal("hide");
            $('.save-note-button').attr('disabled', false);
            $("#note-list").html('<div class="spinner-border text-primary" role="status"> <span class="sr-only"></span>  </div>');
            NoteService.list();

        }
      });

    },

  delete: function(id){
       $('.note-button').attr('disabled', true);
       $.ajax({
       url: 'rest/notes/' + id,
       type: 'DELETE',
       success: function(result) {
           $("#note-list").html('<div class="spinner-border text-primary" role="status"> <span class="sr-only"></span>  </div>');
           NoteService.list();

       }
     });

  }

}
