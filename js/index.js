document.addEventListener('DOMContentLoaded', function () {
    const productTypeSelect = document.getElementById("productType");
    const formContainers = {
        dvd : document.getElementById("DVD"),
        furniture : document.getElementById("furniture"),
        book : document.getElementById("book"),
    };

    // Add event listener to the select element
        productTypeSelect.addEventListener("change", function () {
        // Get the selected option value
        const selectedOption = productTypeSelect.value;

        // Hide all form containers
        Object.values(formContainers).forEach((container) => {
            container.style.display = "none";
        });

        // Show the selected form container
        if (selectedOption in formContainers) {
            formContainers[selectedOption].style.display = "block";
        }
    });
    massDelete();

});

  // Function to handle mass delete
  function massDelete() {
    const checkboxes = document.getElementsByClassName('product-checkbox');
    const skusToDelete = [];

    // Get the checked checkboxes
    for (let i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        skusToDelete.push(checkboxes[i].getAttribute('data-sku'));
      }
    }

    // Perform the delete operation
    if (skusToDelete.length > 0) {
      const formData = new FormData();
      formData.append('delete', skusToDelete.join(','));

      // Send the delete request
      fetch('delete-products.php', {
        method: 'POST',
        body: formData
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Success
            console.log('Products deleted successfully:', data.skus);
            location.reload();
          } else {
            // Failure
            console.error('Failed to delete products:', data.error);
          }
        })
        .catch((error) => {
          console.error('Error occurred while deleting products:', error);
        });
    }
  }

  // Attach event listener to the mass delete button
  const massDeleteButton = document.querySelector('.delete-checkbox');
  massDeleteButton.addEventListener('click', massDelete);
