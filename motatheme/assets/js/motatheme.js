document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#ajax_call').addEventListener('click', function() {
      let formData = new FormData();
      formData.append('action', 'request_photos');
   
   
      fetch(motatheme_js.ajax_url, {
        method: 'POST',
        body: formData,
      }).then(function(response) {
        if (!response.ok) {
          throw new Error('Network response error.');
        }
   
   
        return response.json();
      }).then(function(data) {
        data.posts.forEach(function(post) {
          document.querySelector('#ajax_return').insertAdjacentHTML('beforeend', '<div class="col-12 mb-5">' + post.post_title + '</div>');
        });
      }).catch(function(error) {
        console.error('There was a problem with the fetch operation: ', error);
      });
    });
   });