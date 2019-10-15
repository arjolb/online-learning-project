//Variables
let deleteNote = document.querySelectorAll('.delete-note');
let editNote = document.querySelectorAll('.edit-note');
let updateNote = document.querySelectorAll('.update-note');
let submitNote = document.querySelector('.submit-note');

//Events
noteEvents();

function noteEvents() {
    // for (var i = 0 ; i < deleteNote.length; i++) {
        // deleteNote[i].addEventListener('click' , deleteNoteFn , false ) ; 
    // }
    // for (var i = 0 ; i < editNote.length; i++) {
        // editNote[i].addEventListener('click' , editNoteFn , false ) ; 
    // }
    // for (let i = 0; i < updateNote.length; i++) {
        // updateNote[i].addEventListener('click',updateNoteFn);    
    // }
    jQuery(function ($) {
    $(".note-container").on("click", ".delete-note", deleteNoteFn);
    $(".note-container").on("click", ".edit-note", editNoteFn);
    $(".note-container").on("click", ".update-note", updateNoteFn);

    });

    if (submitNote) {
      submitNote.addEventListener('click',submitNoteFn);
    }
}

//Functions
function deleteNoteFn(e) {
    jQuery(function ($) {
    var thisNote = $(e.target).parent("div");
    $.ajax({
        beforeSend: (xhr) => {
          xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
        },
        url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
        type: 'DELETE',
        success: (response) => {
          thisNote.slideUp();
          console.log("Congrats");
          console.log(response);
          if (response.userNoteCount<5) {
            $('.create-note__limit').css({'opacity' : '0', 'visibility': 'hidden'});
          }
        },
        error: (response) => {
          console.log("Sorry");
          console.log(response);
        }
      });
    });
    // let thisNote = e.target.parentElement;
    // let ajax = new XMLHttpRequest();
    // ajax.onreadystatechange=function () {
        // if (this.readyState==4 && this.status==200) {
            // console.log(JSON.parse(this.responseText));
            // if (thisNote) {
                // thisNote.classList.add('note-remove');
            // }
            // 
        // }else{
            // console.log(this.status)
        // }
    // }
    // 
    // ajax.open('DELETE',universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.getAttribute('data-id'));
    // ajax.setRequestHeader('X-WP-Nonce', universityData.nonce);
    // ajax.send();
}

function editNoteFn(e) {
    let thisNote = e.target.parentElement;
    if (thisNote.getAttribute("data-state") == "editable") {
      makeNoteReadOnly(thisNote);
    //   console.log('!!!!!!!!!!');
    }else{
        makeNoteEditable(thisNote);
    }
}

function makeNoteReadOnly(thisNote) {
    //Edit
    thisNote.children[1].innerHTML='<i class="fa fa-edit" aria-hidden="true"></i> Edit';
    //Input
    thisNote.children[0].setAttribute('readonly',true);
    thisNote.children[0].classList.remove('note-active-field');
    //Textarea
    thisNote.children[3].setAttribute('readonly',true);
    thisNote.children[3].classList.remove('note-active-field');
    //Save
    thisNote.children[4].classList.remove('update-note-visible');
    thisNote.setAttribute('data-state','cancel');
}

function makeNoteEditable(thisNote) {
    //Edit
    thisNote.children[1].innerHTML='<i class="fa fa-times" aria-hidden="true"></i> Cancel';
    //Input
    thisNote.children[0].removeAttribute('readonly');
    thisNote.children[0].classList.add('note-active-field');
    //Textarea
    thisNote.children[3].removeAttribute('readonly');
    thisNote.children[3].classList.add('note-active-field');
    //Save
    thisNote.children[4].classList.add('update-note-visible');
    thisNote.setAttribute('data-state','editable');
}

function updateNoteFn(e) {
    let thisNote = e.target.parentElement;

    let updatedNote={
        'title' : thisNote.children[0].value,
        'content' : thisNote.children[3].value
    }

    let ajax = new XMLHttpRequest();
    ajax.onreadystatechange=function () {
        if (this.readyState==4 && this.status==200) {
            console.log(JSON.parse(this.responseText));
            makeNoteReadOnly(thisNote);
        }
    }
    
    ajax.open('POST',universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.getAttribute('data-id'));
    ajax.setRequestHeader('X-WP-Nonce', universityData.nonce);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.send(`title=${updatedNote.title}&content=${updatedNote.content}`);
}




function submitNoteFn(){
    jQuery(function ($) {

        var ourNewPost = {
            'title': $(".create-note__title").val(),
            'content': $(".create-note__content").val(),
            'status': 'publish'
          }


        $.ajax({
            beforeSend: (xhr) => {
              xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/',
            type: 'POST',
            data: ourNewPost,
            success: (response) => {
              $(".create-note__title, .create-note__content").val('');
              $(`
                <div class="note" data-id="${response.id}" data-state="cancel">
                  <input readonly class="note-title-field" value="${response.title.raw}">
                  <span class="edit-note"><i class="fa fa-edit" aria-hidden="true"></i> Edit</span>
                  <span class="delete-note"><i class="fas fa-trash"></i> Delete</span>
                  <textarea readonly class="note-body-field">${response.content.raw}</textarea>
                  <span class="update-note update-note__btn"><i class="fa fa-arrow-right" aria-hidden="true"></i> Save</span>
                </div>
                `).prependTo(".note-container").hide().slideDown();
      
              console.log("Congrats");
              console.log(response);
            },
            error: (response) => {
              if (response.responseText=="You have reached your note limit.") {
                $('.create-note__limit').css({'opacity' : '1', 'visibility': 'visible'});
              }
              console.log("Sorry");
              console.log(response);
            }
          });
    });
}
