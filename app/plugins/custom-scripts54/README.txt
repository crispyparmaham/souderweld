INITIALIZE WITH HTML
Single images. Add a data-lightbox attribute to any image link to enable Lightbox. For the value of the attribute, use a unique name for each image. For example:
<a href="images/image-1.jpg" data-lightbox="image-1" data-title="My caption">Image #1</a>


Optional:
Add a data-title attribute if you want to show a caption.
Add a data-alt attribute if you want to set the alt attribute of the linked image.
Image sets. If you have a group of related images that you would like to combine into a set, use the same data-lightbox attribute value for all of the images. For example:

<a href="images/image-2.jpg" data-lightbox="roadtrip">Image #2</a>
<a href="images/image-3.jpg" data-lightbox="roadtrip">Image #3</a>
<a href="images/image-4.jpg" data-lightbox="roadtrip">Image #4</a>