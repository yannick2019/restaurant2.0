document.addEventListener("DOMContentLoaded", requestImages);

function requestImages() {
    fetch('http://localhost:8888/restaurant2.0/restaurant-backend/upload-image.php', { method: 'GET' })
        .then(res => res.json())
        .then((data) => {
            //console.log(data);
            const imagesFromDatbase = data.images;
            //console.log(imagesFromDatbase);
            const container = document.querySelector('.images-container');
            //console.log(container);
            if (imagesFromDatbase) {
                imagesFromDatbase.forEach(image => {
                    //console.log(image.filename);
                    const divCol = document.createElement("div");
                    divCol.className = "col-lg-3 col-md-4";

                    const divGalleryItem = document.createElement("div");
                    divGalleryItem.className = "gallery-item";

                    const a = document.createElement("a");
                    const fileName = image.filename;
                    const path = "./upload-img-gallery/"
                    const link = path + fileName 
                    a.setAttribute("href", link);
                    a.className = "gallery-lightbox";
                    a.setAttribute("data-gall", "gallery-item");
                    a.setAttribute("target", "_blank");
                                        
                    const img = document.createElement("img");
                    img.setAttribute("src", link);
                    img.setAttribute("alt", "picture");
                    img.className = "img-fluid";

                    a.appendChild(img);
                    divGalleryItem.appendChild(a);
                    divCol.appendChild(divGalleryItem);
                    container.appendChild(divCol);                    
                });
            }
        })
}