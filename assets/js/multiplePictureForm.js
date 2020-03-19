
//Add a picture button variables
var $addPictureButton = $('<button type="button" class="btn btn-info add_picture_button">Ajouter une image</button>');
var $newLinkLi = $('<li></li>').append($addPictureButton);
var $pictureCollectionHolder;


$(document).ready(function() {
    ///////////////////////// Add a button for adding a picture ////////////////////////
    // Get the ul that holds the collection of Pictures
    $pictureCollectionHolder = $('ul.pictures');

    // add the "add a picture" anchor and li to the tags ul
    $pictureCollectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $pictureCollectionHolder.data('index', $pictureCollectionHolder.find(':input').length);

    $addPictureButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addPictureForm($pictureCollectionHolder, $newLinkLi);
    });

    $('.custom-file-input').on('change', function (e) {
        let inputFile = e.currentTarget;
        $(inputFile).parent()
            .find('.custom-file-label')
            .html(inputFile.files[0].name);
    });

    ///////////////////////// Remove the image field when we click on the delete button ////////////////////////
    $('.pictures').on('click', ".delete-picture", function () {
        $(this).closest('li').remove();
    });

    ///////////////////////// Remove image in DB when we click on the delete button ////////////////////////
    //All the delete button for already in DB picture
    $("a.js-delete-picture").on('click', onClickBtnDelete);
});

function addPictureForm($collectionHolder, $newLinkLi) {
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

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    $('.custom-file-input').on('change', function (e) {
        let inputFile = e.currentTarget;
        $(inputFile).parent()
            .find('.custom-file-label')
            .html(inputFile.files[0].name);
    });
}

function onClickBtnDelete(event) {
    event.preventDefault();
    const url = this.href;

    $.get(
        url,
        function(){
            $("a.js-delete-picture").closest('div.js-picture').remove();
        }
    );
}