function openImage(element) {
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("modalImage");
    var imgUrl = element.style.backgroundImage.slice(5, -2); // Extract URL from inline style
    modal.style.display = "block";
    modalImg.src = imgUrl;
}

// Close the modal
function closeImage() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}