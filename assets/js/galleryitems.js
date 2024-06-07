document.addEventListener("DOMContentLoaded", () => {
  const viewButtons = document.querySelectorAll(".view-button");

  viewButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const priceListContent = getPriceListContent(
        this.getAttribute("data-title")
      );
      updateModalContent(this.getAttribute("data-title"), priceListContent);
    });
  });
});

function getPriceListContent(title) {
  // Define price lists for each service
  const priceLists = {
    "Dog Walks": [
      { type: "Regular", price: "$10 per walk" },
      { type: "Premium", price: "$15 per walk" },
      { type: "Group", price: "$7 per dog (for multiple dogs)" },
    ],
    "Pet Sitting": [
      { type: "Standard", price: "$20 per visit" },
      { type: "Extended", price: "$30 per visit (overnight stay)" },
    ],
    "Vet Visits": [
      { type: "Transport", price: "$15" },
      { type: "Accompaniment", price: "$25" },
    ],
    // Add more services and their price lists as needed
  };

  // Get the price list for the given title
  const priceList = priceLists[title] || [];

  // Generate HTML for the price list
  let content = "<ul>";
  priceList.forEach((item) => {
    content += `<li>${item.type}: ${item.price}</li>`;
  });
  content += "</ul>";

  return priceList.length ? content : "<p>No price information available</p>";
}

function updateModalContent(title, content) {
  const modalTitle = document.getElementById("exampleModalLabel");
  const modalBody = document.getElementById("priceListContent");

  modalTitle.textContent = title;
  modalBody.innerHTML = content;

  const modal = new bootstrap.Modal(
    document.getElementById("exampleModalDefault")
  );
  modal.show();
}
