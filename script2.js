const imageList = document.getElementById('image-list');
  const prevButton = document.getElementById('prev-btn');
  const nextButton = document.getElementById('next-btn');

  function prevImage() {
    imageList.style.transform = 'translateX(100%)';
    setTimeout(() => {
      imageList.insertBefore(imageList.lastElementChild, imageList.firstElementChild);
      imageList.style.transform = 'translateX(0)';
    }, 500);
  }

  function nextImage() {
    imageList.style.transform = 'translateX(-100%)';
    setTimeout(() => {
      imageList.appendChild(imageList.firstElementChild);
      imageList.style.transform = 'translateX(0)';
    }, 500);
  }