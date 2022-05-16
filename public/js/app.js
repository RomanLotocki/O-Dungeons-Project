const addItemLink = document.createElement('a');
addItemLink.classList.add('add_tag_list', 'btn', 'btn-primary');
addItemLink.innerText='Ajouter un objet';
addItemLink.dataset.collectionHolderClass='playableClassItems';

const newLinkLi = document.createElement('li').append(addItemLink)

const collectionHolder = document.querySelector('ul.playableClassItems')
collectionHolder.appendChild(addItemLink)

const addFormToCollection = (e) => {
	const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

      const item = document.createElement('li');

      item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
          /__name__/g,
          collectionHolder.dataset.index
        );

      collectionHolder.appendChild(item);

      collectionHolder.dataset.index++;
      addTagFormDeleteLink(item);
}
addItemLink.addEventListener("click", addFormToCollection);

const addTagFormDeleteLink = (item) => {
    const removeFormButton = document.createElement('button');
    removeFormButton.classList.add('btn', 'btn-danger', 'mb-3');
    removeFormButton.innerText = 'Supprimer cet objet';

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the tag form
        item.remove();
    });
}

const formItems = document.querySelectorAll('ul.playableClassItems li');

for (const formItem of formItems) {
    addTagFormDeleteLink(formItem);
}