//Ajoute un bouton Ajouter une image
var $addPictureButton = $('<button type="button" class="btn btn-info add_picture_button">Ajouter une image</button>');
var $newLinkLi = $('<li></li>').append($addPictureButton);

var $collectionHolder;

$(document).ready(function() {
    // Get the ul that holds the collection of Pictures
    $collectionHolder = $('ul.pictures');

    // add the "add a picture" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addPictureButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addPictureForm($collectionHolder, $newLinkLi);
    });
});

function addPictureForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

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