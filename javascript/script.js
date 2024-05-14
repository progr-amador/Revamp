const searchProduct = document.querySelector('#searchproduct')
if (searchProduct !== '') {
  searchProduct.addEventListener('input', async function() {
    const response = await fetch('../actions/action_search.php?search=' + this.value)
    const products = await response.json()

    const section = document.querySelector('#listing-item')
    section.innerHTML = ''

    for (const product of products) {
      const divFlexItem = document.createElement('div');
      divFlexItem.classList.add('flex-item');
  
      const link = document.createElement('a');
      link.href = '../code/product.php?id=' + product.productID;
  
      const divItemImage = document.createElement('div');
      divItemImage.classList.add('item-image');
  
      const img = document.createElement('img');
      img.src = product.photoURL;
      img.alt = 'Image for ' + product.title;
  
      const divItemDetails = document.createElement('div');
      divItemDetails.classList.add('item-details');
  
      const h3Title = document.createElement('h3');
      h3Title.textContent = product.title;
  
      const pPrice = document.createElement('p');
      pPrice.textContent = product.price + ' €';
  
      const pLocation = document.createElement('p');
      pLocation.textContent = product.location;
  
      divItemImage.appendChild(img);
      divItemDetails.appendChild(h3Title);
      divItemDetails.appendChild(pPrice);
      divItemDetails.appendChild(pLocation);
  
      link.appendChild(divItemImage);
      link.appendChild(divItemDetails);
  
      divFlexItem.appendChild(link);
      section.appendChild(divFlexItem);
  }
  })
}