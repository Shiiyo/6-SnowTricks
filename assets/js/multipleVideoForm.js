
//Add a picture button variables
var $addVideoButton = $('<button type="button" class="btn btn-outline-info add_video_button">Ajouter une vidéo</button>');
var $newLinkLi = $('<li></li>').append($addVideoButton);
var $collectionHolder;


$(document).ready(function() {
    ///////////////////////// Add a button for adding a video ////////////////////////
    // Get the ul that holds the collection of Videos
    $collectionHolder = $('ul.videos');

    // add the "add a video" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addVideoButton.on('click', function () {
        // add a new tag form (see next code block)
        addVideoForm($collectionHolder, $newLinkLi);
    });

    ///////////////////////// Remove the video field when we click on the delete button ////////////////////////
    $('.videos').on('click', ".delete-video", function () {
        $(this).closest('li').remove();
    });

    ///////////////////////// Remove video in DB when we click on the delete button ////////////////////////
    //All the delete button for already in DB picture
    $("a.js-delete-video").on('click', onClickBtnDelete);
});

function addVideoForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a video" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    $('label.required').remove();
}

function onClickBtnDelete(event) {
    event.preventDefault();
    const url = this.href;

    $.get(
        url,
        function(){
            $("a.js-delete-video").closest('div.js-video').remove();
        }
    );
}