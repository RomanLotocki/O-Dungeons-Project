const app = {

    // Initialization of the component at the end of DOM Loading
    init : function() {
        // We are creating a new link to add a new form
        const addItemLink = document.createElement('a');
        addItemLink.classList.add('add_tag_list', 'btn', 'btn-primary', 'mb-2');
        addItemLink.innerText='Ajouter un objet';
        // Relating to the tag which holds the prototype of a form
        addItemLink.dataset.collectionHolderClass='playableClassItems';

        // Adding the link at the end of list of forms 
        const collectionHolder = document.querySelector('ul.playableClassItems');
        collectionHolder.appendChild(addItemLink);

        // Adding event listener on link addItemLink
        // When the event is triggered, this is adding a new form
        addItemLink.addEventListener("click", app.addFormToCollection);

        // Select every forms 
        const formItems = document.querySelectorAll('ul.playableClassItems li');

        // On each form, adding a delete button
        for (const formItem of formItems) {
            app.addTagFormDeleteLink(formItem);
        }
    },

    // Handler to add a new form
    addFormToCollection : function (e)  {
        // Select the ul tag
	    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

        // Creating a list item to put in the form
        const item = document.createElement('li');

        // Grabbing the form from the ul data-prototype and placing it inside the new list item
        item.innerHTML = collectionHolder
            .dataset
            .prototype
            .replace(
            /__name__/g,
            collectionHolder.dataset.index
            );
        // Adding at the end the list item
        collectionHolder.appendChild(item);

        collectionHolder.dataset.index++;
        app.addTagFormDeleteLink(item);
    },

    addTagFormDeleteLink: function (item) {
        const removeFormButton = document.createElement('button');
        removeFormButton.classList.add('btn', 'btn-danger', 'mb-3');
        removeFormButton.innerText = 'Supprimer cet objet';

        item.append(removeFormButton);

        removeFormButton.addEventListener('click', (e) => {
            e.preventDefault();
            // remove the li for the tag form
            item.remove();

            const collectionHolder = document.querySelector('ul.playableClassItems');
            collectionHolder.dataset.index--;
        });
    }  
}

document.addEventListener('DOMContentLoaded', app.init);