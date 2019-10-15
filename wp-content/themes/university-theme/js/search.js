//Variables
let openOverlayButton = document.querySelector('.site-navigation__search-icon');
let closeOverlayButton = document.querySelector('.search-overlay__close');
let searchOverlay = document.querySelector('.search-overlay');
let isOverlayOpen = false;
let searchTerm = document.querySelector('#search-term');
let typingTimer;
let resultsDiv = document.querySelector('.search-overlay__results');
let spinnerVisible = false;
let previousValue;
let inputField = document.querySelector('input');
let textareaField = document.querySelector('textarea');
//Events
events();

function events() {
    openOverlayButton.addEventListener('click',openOverlay);
    closeOverlayButton.addEventListener('click',closeOverlay);
    document.addEventListener('keydown',keyPressOverlay)
    searchTerm.addEventListener('keyup',typingLogic);
}


//Functions

function openOverlay(e) {
    searchOverlay.classList.add('search-overlay__active');
    document.body.classList.add('body-no-scroll');
    isOverlayOpen = true;
    setTimeout(() => {
        searchTerm.focus();
    }, 301);
    searchTerm.value='';
    return false;
}

function closeOverlay(e) {
    searchOverlay.classList.remove('search-overlay__active');
    document.body.classList.remove('body-no-scroll');
    isOverlayOpen = false;
    searchTerm.blur();
    resultsDiv.innerHTML='';
}

function keyPressOverlay(e) {
    if (!textareaField) {
        if(e.keyCode == 83 && !isOverlayOpen && !inputField.matches(":focus")){
            openOverlay();
        }
    }
    if (textareaField) {
        if(e.keyCode == 83 && !isOverlayOpen && !inputField.matches(":focus") && !textareaField.matches(":focus")){
            openOverlay();
        }
    }
    // jQuery(function ($) {
    // if (e.keyCode == 83 && !isOverlayOpen && !$("input, textarea").is(':focus')) {
    //     sopenOverlay();
    // }
    // });

    if (e.keyCode==27 && isOverlayOpen) {
        closeOverlay();
    }
}

function typingLogic(e) {
    if (searchTerm.value != previousValue) {
        clearTimeout(typingTimer);

        if (searchTerm.value) {
            typingTimer=setTimeout(getResults,850);
            if (!spinnerVisible) {
                resultsDiv.innerHTML = '<div class="spinner-loader"></div>';
                spinnerVisible = true;
            }
        }else{
            resultsDiv.innerHTML='';
            spinnerVisible = false;
        }

        
    }


    
    previousValue = searchTerm.value;
}

function getResults() {
    let ajax = new XMLHttpRequest();
    ajax.onreadystatechange=function () { 
        if (this.readyState==4 && this.status==200) {
            var responseText = JSON.parse(this.responseText);
            resultsDiv.innerHTML = `
            <div class='row row-gutters'>
                <div class='col-md-4'>
                    <h2>Generic Blog posts and pages</h2>
                    ${responseText.generalInfo.length ? '<ul>' : '<p>No results!</p>'}
                        ${responseText.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                    ${responseText.generalInfo.length ? '</ul>' : ''}  
                </div>
                    
                <div class='col-md-4'>
                    <h2>subjects</h2>
                    ${responseText.subjects.length ? '<ul>' : '<p>No subjects!</p>'}
                        ${responseText.subjects.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                    ${responseText.subjects.length ? '</ul>' : ''}
                </div>

                <div class='col-md-4'>
                    <h2>Professors</h2>
                    ${responseText.professors.length ? '<ul>' : '<p>No Professors!</p>'}
                        ${responseText.professors.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                    ${responseText.professors.length ? '</ul>' : ''}

                    <h2>Lectures</h2>
                    ${responseText.lectures.length ? '' : '<p>No Lectures match that search.</p>'}
                        ${responseText.lectures.map(item=>`
                    <div class="events__info">    
                        <div class="events__info-">
                            <div class="row row-gutters">
                                <div class="col-md-3">
                                    <div class="events__info-date">
                                        <h4>${item.dayOfTheWeek}</h4>  
                                        <h4>${item.day}</h4>
                                        <h4>${item.month}</h4>
                                    </div>                                    
                                </div>

                                <div class="col-md-9">
                                    <h3>         
                                       <a href="${item.permalink}">
                                       </a>
                                    </h3>
                                    <h3>${item.title}</h3>

                                </div>

                            </div>
                        </div>
                    </div>    
                        `).join('')
                    }
                </div>
            </div>
            `;
            console.log(responseText);
        }
    }
    ajax.open('GET',`http://localhost:3000/wordpress-project/wp-json/university/v1/search?keyword=${searchTerm.value}`,true);
    ajax.send();


    spinnerVisible = false;
}