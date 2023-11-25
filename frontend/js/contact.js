function submitContactForm() {
    const form = document.getElementById("contactForm");
    const formData = new FormData(form);

    const jsonData = {};
    formData.forEach((value, key) => {
        jsonData[key] = value;
    });
    console.log(jsonData);
    fetch('http://localhost:8888/restaurant2.0/backend/contact.php', {
        method: 'POST',
        mode: "cors",
        credentials: "include",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(jsonData)
    })
    .then((response => {
        return response.text(); 
    }))
    .then((data) => {
        alert(data);
    })
    .catch(err => { console.log(err) }); 
}

