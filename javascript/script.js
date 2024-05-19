const searchProduct = document.querySelector('#searchproduct');
let currentFilters = {};

if (searchProduct) {
  searchProduct.addEventListener('input', async function() {
    if(this.value === '') return
    const params = new URLSearchParams();
    params.append('search', this.value);
    for (const key in currentFilters) {
      if (currentFilters[key] !== '') {
        params.append(key, currentFilters[key]);
      }
    }

    const response = await fetch('../actions/action_search.php?' + params.toString());
    const products = await response.json();

    const section = document.querySelector('#listing-item');
    section.innerHTML = '';

    if (products.length > 0) {
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
    } else {
      section.innerHTML = '<p>No results found</p>';
    }
  });
}

const filterInputs = document.querySelectorAll('#ordem select, #condição select, #regiao select, #categoria select, #marca select, #price_min input, #price_max input');
filterInputs.forEach(input => {
  input.addEventListener('change', function() {
    currentFilters[this.name] = this.value;
    searchProduct.dispatchEvent(new Event('input'));
  });
});



function handlePaymentMethodChange() {
  const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
  const toggleGroups = document.querySelectorAll('[data-toggle-group]');

  if (selectedMethod) {
    const selectedGroup = document.querySelector(`[data-toggle-group="${selectedMethod.dataset.toggleValue}"]`);

    toggleGroups.forEach(group => {
      const inputs = group.querySelectorAll('input[type]');
      inputs.forEach(input => {
        input.required = group === selectedGroup;
      });
      group.style.display = group === selectedGroup ? 'block' : 'none';
    });
  }
}

document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
  radio.addEventListener('change', handlePaymentMethodChange);
});

