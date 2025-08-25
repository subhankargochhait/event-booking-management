<?php
include("../config/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Your Event | EventHub</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    * { font-family: 'Inter', sans-serif; }

    .glass-effect { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2); }
    .gradient-bg { background: linear-gradient(135deg, #f7962d 0%, #ff8c42 100%); }
    .input-focus:focus { border-color: #f7962d !important; box-shadow: 0 10px 25px rgba(247,150,45,0.25); outline:none; }
    .hover-lift:hover { transform: translateY(-3px); }
    .floating-label { pointer-events:none; position:absolute; left:16px; top:16px; color:#9ca3af; background:white; padding:0 4px; z-index:10; transition:0.3s ease; }
    .form-group:focus-within .floating-label,
    .form-group.has-value .floating-label { transform: translateY(-28px) scale(0.875); color:#f7962d; background:white; }
    .file-upload-area { transition:0.3s; border:2px dashed #d1d5db; background:white; cursor:pointer; }
    .file-upload-area.dragover { border-color:#f7962d; background:#fff7ed; }
  </style>
</head>
<body class="min-h-screen bg-gray-50">
  <?php include("../includes/user_header.php"); ?>

  <div class="container mx-auto px-4 py-12">
    <div class="max-w-5xl mx-auto glass-effect rounded-3xl shadow-2xl overflow-hidden">
      <div class="gradient-bg p-8 text-white text-center">
        <h2 class="text-3xl font-bold mb-2"><i class="fas fa-calendar-plus mr-2"></i>Create Your Event</h2>
        <p>Fill in details to bring your event to life</p>
      </div>
      <div class="p-8">
        <form action="create_event.php" method="POST" enctype="multipart/form-data" class="space-y-6" id="eventForm">

          <div class="grid md:grid-cols-2 gap-6">
            <div class="form-group relative">
              <input type="text" name="name" placeholder=" " class="w-full border-2 border-gray-200 rounded-xl h-14 px-4 input-focus" required>
              <label class="floating-label"><i class="fas fa-star mr-1 text-orange-500"></i> Event Name *</label>
            </div>

           <div class="form-group relative">
  <select name="category" required 
          class="w-full border-2 border-gray-200 rounded-xl h-14 px-3 input-focus appearance-none bg-white">
    <option value="" disabled >Select Category</option>
    <option value="Festival">Festival 🎉</option>
    <option value="Tech">Tech 💻</option>
    <option value="Cultural">Cultural 🎭</option>
    <option value="Sports">Sports ⚽</option>
    <option value="Workshops">Workshops 🔧</option>
    <option value="Conferences">Conferences 📊</option>
    <option value="Concerts">Concerts 🎵</option>
    <option value="Educational">Educational 📚</option>
    <option value="Community">Community 🤝</option>
    <option value="Art & Exhibitions">Art & Exhibitions 🎨</option>
    <option value="Film & Theatre">Film & Theatre 🎬</option>
    <option value="Meetups">Meetups ☕</option>
    <option value="Networking">Networking 🌐</option>
    <option value="Seminars & Training">Seminars & Training 🎓</option>
    <option value="Fairs & Expos">Fairs & Expos 🏪</option>
    <option value="Wedding">Wedding 💒</option>
  </select>
  <label class="floating-label"><i class="fas fa-tag mr-1 text-orange-500"></i> Category *</label>
  <i class="fas fa-chevron-down absolute right-4 top-5 text-gray-400 pointer-events-none"></i>
</div>

          </div>

          <div class="grid md:grid-cols-3 gap-6">
            <div class="form-group relative">
              <input type="date" name="event_date" placeholder=" " class="w-full border-2 border-gray-200 rounded-xl h-14 px-4 input-focus" required>
              <label class="floating-label"><i class="fas fa-calendar-alt mr-1 text-orange-500"></i> Event Date *</label>
            </div>
            <div class="form-group relative">
              <input type="time" name="start_time" placeholder=" " class="w-full border-2 border-gray-200 rounded-xl h-14 px-4 input-focus" required>
              <label class="floating-label"><i class="fas fa-play mr-1 text-orange-500"></i> Start Time *</label>
            </div>
            <div class="form-group relative">
              <input type="time" name="end_time" placeholder=" " class="w-full border-2 border-gray-200 rounded-xl h-14 px-4 input-focus" required>
              <label class="floating-label"><i class="fas fa-stop mr-1 text-orange-500"></i> End Time *</label>
            </div>
          </div>

          <div class="grid md:grid-cols-2 gap-6">
            <div class="form-group relative">
              <input type="number" name="price" placeholder=" " min="0" step="0.01" class="w-full border-2 border-gray-200 rounded-xl h-14 px-4 pl-8 input-focus" required>
              <span class="absolute left-4 top-4 text-orange-500 text-lg">₹</span>
              <label class="floating-label" style="left:32px;">Price *</label>
            </div>
            <div class="form-group relative">
              <input type="number" name="capacity" placeholder=" " min="1" class="w-full border-2 border-gray-200 rounded-xl h-14 px-4 input-focus" required>
              <label class="floating-label"><i class="fas fa-users mr-1 text-orange-500"></i> Capacity *</label>
            </div>
          </div>

          <div class="grid md:grid-cols-2 gap-6">
            <div class="form-group relative">
              <input type="text" name="location" placeholder=" " class="w-full border-2 border-gray-200 rounded-xl h-14 px-4 input-focus" required>
              <label class="floating-label"><i class="fas fa-map-marker-alt mr-1 text-orange-500"></i> Location *</label>
            </div>
            <div class="form-group relative">
              <input type="text" name="highlights" placeholder=" " class="w-full border-2 border-gray-200 rounded-xl h-14 px-4 input-focus">
              <label class="floating-label"><i class="fas fa-sparkles mr-1 text-orange-500"></i> Highlights</label>
            </div>
          </div>

          <!-- Description -->
          <div class="form-group relative">
            <textarea name="description" rows="4" placeholder=" " class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 input-focus resize-none"></textarea>
            <label class="floating-label"><i class="fas fa-align-left mr-1 text-orange-500"></i> Event Description</label>
          </div>

          <!-- Image Upload -->
          <div class="file-upload-area rounded-xl p-6 border-2 border-dashed border-gray-300 text-center">
            <p class="text-gray-500"><i class="fas fa-cloud-upload-alt text-3xl mb-2"></i><br>Drop your image or click to browse</p>
            <input type="file" name="event_image" accept="image/*" id="fileInput" >
            <div id="imagePreview" class="mt-4 hidden">
              <img id="previewImg" class="mx-auto w-32 h-32 object-cover rounded-lg border-2 border-gray-200">
            </div>
          </div>

          <!-- Submit -->
          <div class="text-center pt-4">
            <button type="submit" name="add_event" class="gradient-bg text-white px-12 py-4 rounded-xl font-semibold hover:shadow-xl transition-all">
              <i class="fas fa-rocket mr-2"></i> Create Event
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <?php include("../includes/footer.php"); ?>

  <script>
    // Floating label handling
    document.querySelectorAll('.form-group input, .form-group textarea, .form-group select').forEach(input => {
      input.addEventListener('input', function() {
        if(this.value.trim() !== '') this.parentNode.classList.add('has-value');
        else this.parentNode.classList.remove('has-value');
      });
      if(input.value.trim() !== '') input.parentNode.classList.add('has-value');
    });

    // Image preview
    const fileInput = document.getElementById('fileInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    fileInput.addEventListener('change', e => {
      const file = e.target.files[0];
      if(file){
        const reader = new FileReader();
        reader.onload = function(e){
          previewImg.src = e.target.result;
          imagePreview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
      }
    });

    // Drag & Drop
    const fileArea = document.querySelector('.file-upload-area');
    fileArea.addEventListener('dragover', e => { e.preventDefault(); fileArea.classList.add('dragover'); });
    fileArea.addEventListener('dragleave', e => { e.preventDefault(); fileArea.classList.remove('dragover'); });
    fileArea.addEventListener('drop', e => {
      e.preventDefault();
      fileArea.classList.remove('dragover');
      const files = e.dataTransfer.files;
      if(files.length > 0) fileInput.files = files;
      fileInput.dispatchEvent(new Event('change'));
    });
  </script>
</body>
</html>
