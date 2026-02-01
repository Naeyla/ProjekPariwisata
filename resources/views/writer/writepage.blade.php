<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KisahOmbak - Write</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Libre+Baskerville:wght@400;700&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        logo: ['Great Vibes', 'cursive'],
                        body: ['Libre Baskerville', 'serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="font-body bg-white text-gray-800">

    <!-- Header -->
    <header class="sticky top-0 bg-white border-b border-gray-200 z-50">
        <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-logo text-blue-900">KisahOmbak</h1>
                <span class="text-sm text-gray-500" id="status-text">Draft</span>
                <span class="text-sm text-gray-500 hidden" id="saved-text">Saved</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative">
                    <button id="publish-btn"
                        class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition">
                        Publish
                    </button>
                    <div id="publish-dropdown"
                        class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <button id="publish-now"
                            class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded-t-lg">Publish now</button>
                        <button id="publish-scheduled"
                            class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded-b-lg">Schedule</button>
                    </div>
                </div>
                <button class="text-gray-600 hover:text-gray-800">⋯</button>
                <button class="text-gray-600 hover:text-gray-800">🔔</button>
                <div class="w-8 h-8 bg-gray-400 rounded-full"></div>
            </div>
        </div>
    </header>

    <!-- Main Editor -->
    <main class="max-w-4xl mx-auto px-6 py-8">
        <!-- Cover Image Upload (appears when title is focused) -->
        <div id="cover-image-section" class="hidden mb-6">
            <label class="block mb-2 text-sm text-gray-600">Cover Image</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-blue-500"
                id="cover-upload-area">
                <input type="file" id="cover-image-input" accept="image/*" class="hidden">
                <div class="text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <p>Click to upload cover image</p>
                </div>
            </div>
            <div id="cover-preview" class="hidden mt-4">
                <img id="cover-preview-img" src="" alt="Cover"
                    class="max-w-full h-64 object-cover rounded-lg">
                <button id="remove-cover" class="mt-2 text-red-600 hover:text-red-800 text-sm">Remove cover</button>
            </div>
        </div>

        <!-- Title Editor -->
        <div class="relative mb-8">
            <div contenteditable="true" id="title-editor"
                class="text-5xl font-bold outline-none focus:outline-none min-h-[60px]" placeholder="Title"
                data-placeholder="Title"></div>
            <button id="add-cover-btn"
                class="absolute left-[-60px] top-2 w-10 h-10 rounded-full border border-gray-300 bg-white hover:bg-gray-50 flex items-center justify-center text-gray-600 hover:text-gray-800 hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </button>
        </div>

        <!-- Content Editor -->
        <div class="relative">
            <div contenteditable="true" id="content-editor"
                class="text-xl outline-none focus:outline-none min-h-[400px] leading-relaxed"
                placeholder="Share your experience" data-placeholder="Share your experience"></div>

            <!-- Toolbar (appears when text is selected) -->
            <div id="toolbar"
                class="hidden absolute bg-white border border-gray-200 rounded-lg shadow-lg p-2 flex items-center gap-2 z-50">
                <button id="bold-btn" class="px-3 py-1 hover:bg-gray-100 rounded font-bold">B</button>
                <button id="italic-btn" class="px-3 py-1 hover:bg-gray-100 rounded italic">I</button>
                <select id="font-size" class="px-2 py-1 border border-gray-300 rounded">
                    <option value="16px">Normal</option>
                    <option value="18px">Large</option>
                    <option value="20px">Larger</option>
                    <option value="24px">Largest</option>
                </select>
            </div>

            <!-- Add Content Button -->
            <button id="add-content-btn"
                class="absolute left-[-60px] top-0 w-10 h-10 rounded-full border border-gray-300 bg-white hover:bg-gray-50 flex items-center justify-center text-gray-600 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </button>
        </div>
    </main>

    <!-- Schedule Modal -->
    <div id="schedule-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-xl font-bold mb-4">Schedule Publication</h2>
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-2">Date & Time</label>
                <input type="datetime-local" id="schedule-datetime"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="flex gap-3">
                <button id="confirm-schedule"
                    class="flex-1 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Schedule</button>
                <button id="cancel-schedule"
                    class="flex-1 bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Add Content Modal -->
    <div id="add-content-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-xl font-bold mb-4">Add Content</h2>
            <div class="flex flex-col gap-3">
                <button id="add-image-btn"
                    class="w-full border border-gray-300 rounded px-4 py-3 hover:bg-gray-50 text-left">
                    📷 Add Image
                </button>
                <button id="add-video-btn"
                    class="w-full border border-gray-300 rounded px-4 py-3 hover:bg-gray-50 text-left">
                    🎥 Add Video
                </button>
                <button id="close-content-modal"
                    class="w-full bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 mt-2">Cancel</button>
            </div>
        </div>
    </div>

    <input type="file" id="image-input" accept="image/*" class="hidden">
    <input type="file" id="video-input" accept="video/*" class="hidden">

    <style>
        [contenteditable][data-placeholder]:empty::before {
            content: attr(data-placeholder);
            color: #9ca3af;
            pointer-events: none;
        }
    </style>


    <script>
        let articleId = null;
        let autoSaveTimer = null;
        let currentArticleId = null;

        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Title Editor
        const titleEditor = document.getElementById('title-editor');
        const addCoverBtn = document.getElementById('add-cover-btn');
        const coverImageSection = document.getElementById('cover-image-section');
        const coverImageInput = document.getElementById('cover-image-input');
        const coverUploadArea = document.getElementById('cover-upload-area');
        const coverPreview = document.getElementById('cover-preview');
        const coverPreviewImg = document.getElementById('cover-preview-img');
        const removeCoverBtn = document.getElementById('remove-cover');
        let coverImageUrl = '';

        // Content Editor
        const contentEditor = document.getElementById('content-editor');
        const addContentBtn = document.getElementById('add-content-btn');
        const toolbar = document.getElementById('toolbar');
        const boldBtn = document.getElementById('bold-btn');
        const italicBtn = document.getElementById('italic-btn');
        const fontSizeSelect = document.getElementById('font-size');

        // Publish
        const publishBtn = document.getElementById('publish-btn');
        const publishDropdown = document.getElementById('publish-dropdown');
        const publishNowBtn = document.getElementById('publish-now');
        const publishScheduledBtn = document.getElementById('publish-scheduled');
        const scheduleModal = document.getElementById('schedule-modal');
        const scheduleDatetime = document.getElementById('schedule-datetime');
        const confirmScheduleBtn = document.getElementById('confirm-schedule');
        const cancelScheduleBtn = document.getElementById('cancel-schedule');

        // Add Content Modal
        const addContentModal = document.getElementById('add-content-modal');
        const addImageBtn = document.getElementById('add-image-btn');
        const addVideoBtn = document.getElementById('add-video-btn');
        const closeContentModal = document.getElementById('close-content-modal');
        const imageInput = document.getElementById('image-input');
        const videoInput = document.getElementById('video-input');

        // Status
        const statusText = document.getElementById('status-text');
        const savedText = document.getElementById('saved-text');

        // Placeholder handling
        function handlePlaceholder(element) {
            if (element.textContent.trim() === '') {
                element.textContent = '';
            }
        }

        titleEditor.addEventListener('focus', function() {
            if (this.textContent === 'Title') {
                this.textContent = '';
            }
            addCoverBtn.classList.remove('hidden');
        });

        titleEditor.addEventListener('blur', function() {
            if (this.textContent.trim() === '') {
                this.textContent = 'Title';
            }
            addCoverBtn.classList.add('hidden');
            autoSave();
        });


        // Add Cover Image
        addCoverBtn.addEventListener('click', () => {
            coverImageSection.classList.remove('hidden');
        });

        coverUploadArea.addEventListener('click', () => {
            coverImageInput.click();
        });

        coverImageInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', csrfToken);

                try {
                    const response = await fetch('/writer/write/upload-image', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();
                    if (data.success) {
                        coverImageUrl = data.url;
                        coverPreviewImg.src = data.url;
                        coverPreview.classList.remove('hidden');
                        coverUploadArea.classList.add('hidden');
                        autoSave();
                    }
                } catch (error) {
                    console.error('Error uploading image:', error);
                }
            }
        });

        removeCoverBtn.addEventListener('click', () => {
            coverImageUrl = '';
            coverPreview.classList.add('hidden');
            coverUploadArea.classList.remove('hidden');
            coverImageInput.value = '';
            autoSave();
        });

        // Text Selection Toolbar
        contentEditor.addEventListener('mouseup', () => {
            const selection = window.getSelection();
            if (selection.toString().length > 0) {
                const range = selection.getRangeAt(0);
                const rect = range.getBoundingClientRect();
                toolbar.style.top = (rect.top + window.scrollY - 50) + 'px';
                toolbar.style.left = (rect.left + window.scrollX) + 'px';
                toolbar.classList.remove('hidden');
            } else {
                toolbar.classList.add('hidden');
            }
        });

        document.addEventListener('click', (e) => {
            if (!toolbar.contains(e.target) && !contentEditor.contains(e.target)) {
                toolbar.classList.add('hidden');
            }
        });

        boldBtn.addEventListener('click', () => {
            document.execCommand('bold', false, null);
            contentEditor.focus();
        });

        italicBtn.addEventListener('click', () => {
            document.execCommand('italic', false, null);
            contentEditor.focus();
        });

        fontSizeSelect.addEventListener('change', (e) => {
            document.execCommand('fontSize', false, '3');
            const selection = window.getSelection();
            if (selection.rangeCount > 0) {
                const range = selection.getRangeAt(0);
                const span = document.createElement('span');
                span.style.fontSize = e.target.value;
                try {
                    range.surroundContents(span);
                } catch (err) {
                    const contents = range.extractContents();
                    span.appendChild(contents);
                    range.insertNode(span);
                }
            }
            contentEditor.focus();
        });

        // Add Content
        addContentBtn.addEventListener('click', () => {
            addContentModal.classList.remove('hidden');
        });

        closeContentModal.addEventListener('click', () => {
            addContentModal.classList.add('hidden');
        });

        addImageBtn.addEventListener('click', () => {
            imageInput.click();
            addContentModal.classList.add('hidden');
        });

        addVideoBtn.addEventListener('click', () => {
            videoInput.click();
            addContentModal.classList.add('hidden');
        });

        imageInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', csrfToken);

                try {
                    const response = await fetch('/writer/write/upload-image', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();
                    if (data.success) {
                        insertImageToContent(data.url);
                    }
                } catch (error) {
                    console.error('Error uploading image:', error);
                }
            }
        });

        videoInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('video', file);
                formData.append('_token', csrfToken);

                try {
                    const response = await fetch('/writer/write/upload-video', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();
                    if (data.success) {
                        insertVideoToContent(data.url);
                    }
                } catch (error) {
                    console.error('Error uploading video:', error);
                }
            }
        });

        function insertImageToContent(url) {
            const img = document.createElement('img');
            img.src = url;
            img.className = 'max-w-full h-auto my-4 rounded-lg';
            img.setAttribute('contenteditable', 'false');

            contentEditor.appendChild(img);
            contentEditor.appendChild(document.createElement('br'));

            autoSave();
        }


        function insertVideoToContent(url) {
            const video = document.createElement('video');
            video.src = url;
            video.controls = true;
            video.className = 'max-w-full my-4 rounded-lg';
            video.setAttribute('contenteditable', 'false');

            contentEditor.appendChild(video);
            contentEditor.appendChild(document.createElement('br'));

            autoSave();
        }


        // Auto Save Draft
        function autoSave() {
            clearTimeout(autoSaveTimer);
            savedText.classList.add('hidden');

            autoSaveTimer = setTimeout(async () => {
                const title = titleEditor.textContent.trim() === 'Title' ? '' : titleEditor.textContent.trim();
                const content = contentEditor.innerHTML.trim() === 'Share your experience' ? '' : contentEditor
                    .innerHTML.trim();

                if (!title && !content) return;

                const data = {
                    title: title,
                    content: content,
                    cover_image: coverImageUrl,
                    _token: csrfToken
                };

                try {
                    let url = '/writer/write/save-draft';
                    let method = 'POST';
                    let bodyData = {
                        ...data
                    };

                    if (currentArticleId) {
                        url = `/writer/write/update-draft/${currentArticleId}`;
                        method = 'POST';
                        bodyData._method = 'PUT';
                    }

                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(bodyData)
                    });

                    const result = await response.json();
                    if (result.success) {
                        if (!currentArticleId) {
                            currentArticleId = result.article_id;
                        }
                        savedText.classList.remove('hidden');
                        setTimeout(() => {
                            savedText.classList.add('hidden');
                        }, 2000);
                    }
                } catch (error) {
                    console.error('Error saving draft:', error);
                }
            }, 2000);
        }

        // Auto save on input
        titleEditor.addEventListener('input', autoSave);
        contentEditor.addEventListener('input', autoSave);

        // Publish
        publishBtn.addEventListener('click', () => {
            publishDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!publishBtn.contains(e.target) && !publishDropdown.contains(e.target)) {
                publishDropdown.classList.add('hidden');
            }
        });

        publishNowBtn.addEventListener('click', async () => {
            publishDropdown.classList.add('hidden');
            await publishArticle('now');
        });

        publishScheduledBtn.addEventListener('click', () => {
            publishDropdown.classList.add('hidden');
            scheduleModal.classList.remove('hidden');
        });

        confirmScheduleBtn.addEventListener('click', async () => {
            const datetime = scheduleDatetime.value;
            if (!datetime) {
                alert('Please select a date and time');
                return;
            }
            scheduleModal.classList.add('hidden');
            await publishArticle('scheduled', datetime);
        });

        cancelScheduleBtn.addEventListener('click', () => {
            scheduleModal.classList.add('hidden');
        });

        async function publishArticle(type, scheduledAt = null) {
            const title = titleEditor.textContent.trim() === 'Title' ? '' : titleEditor.textContent.trim();
            const content = contentEditor.innerHTML.trim() === 'Share your experience' ? '' : contentEditor.innerHTML
                .trim();

            if (!title || !content) {
                alert('Please fill in title and content');
                return;
            }

            const data = {
                title: title,
                content: content,
                cover_image: coverImageUrl,
                publish_type: type,
                scheduled_at: scheduledAt,
                _token: csrfToken
            };

            try {
                const response = await fetch('/writer/write/publish', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                if (result.success) {
                    alert(result.message);
                    window.location.href = '/storieswriter';
                } else {
                    alert('Error publishing article');
                }
            } catch (error) {
                console.error('Error publishing article:', error);
                alert('Error publishing article');
            }
        }
    </script>
</body>

</html>
