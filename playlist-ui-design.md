# Playlist Creation UI Design

## Overview
This document outlines the design for adding playlist creation functionality to the Peacock Remote application. The design follows the existing jQuery Mobile framework and UI patterns while introducing new components specific to playlist management.

## User Flow

1. User navigates to a new "Playlists" tab in the main navigation
2. User can view existing playlists or create a new one
3. When creating a new playlist, user provides a name and selects content
4. User can reorder, add, or remove items from the playlist
5. User saves the playlist and returns to the playlist overview

## UI Components

### 1. Navigation Integration
Add a new "Playlists" tab to the existing footer navigation:

```html
<footer data-role="footer" data-position="fixed">
    <nav data-role="navbar">
        <ul>
            <li><a href="#tv" data-icon="home">TV</a></li>
            <li><a href="#receiver" data-icon="grid">Receiver</a></li>
            <li><a href="#playlists" data-icon="audio">Playlists</a></li>
            <li><a href="#Power" data-icon="info">Power</a></li>
        </ul>
    </nav>
</footer>
```

### 2. Playlists Overview Page
A new page showing all existing playlists with options to play, edit, or delete them.

![Playlists Overview Wireframe](wireframes/playlists-overview.png)

```html
<div data-role="page" id="playlists">
    <header data-role="header">
        <h1>Playlists</h1>
    </header>
    <article data-role="content">
        <a href="#create-playlist" data-role="button" data-icon="plus" class="ui-btn-right">Create New Playlist</a>
        
        <ul id="playlist-list" data-role="listview" data-inset="true">
            <!-- Dynamically populated list of playlists -->
            <li>
                <a href="#playlist-detail" data-playlist-id="1">
                    <h2>Morning Music</h2>
                    <p>8 tracks · 32 minutes</p>
                </a>
                <a href="#" data-icon="gear" class="ui-btn-right playlist-options">Options</a>
            </li>
            <!-- More playlists... -->
        </ul>
        
        <!-- Empty state when no playlists exist -->
        <div id="no-playlists" class="ui-content" style="display: none;">
            <p>You don't have any playlists yet.</p>
            <a href="#create-playlist" data-role="button" data-icon="plus">Create Your First Playlist</a>
        </div>
    </article>
</div>
```

### 3. Create Playlist Page
A form for creating a new playlist with fields for name, description, and content selection.

![Create Playlist Wireframe](wireframes/create-playlist.png)

```html
<div data-role="page" id="create-playlist">
    <header data-role="header">
        <h1>Create Playlist</h1>
        <a href="#playlists" data-icon="back" class="ui-btn-left">Back</a>
    </header>
    <article data-role="content">
        <form id="playlist-form">
            <div class="ui-field-contain">
                <label for="playlist-name">Playlist Name:</label>
                <input type="text" name="playlist-name" id="playlist-name" placeholder="Enter playlist name" required>
            </div>
            
            <div class="ui-field-contain">
                <label for="playlist-description">Description (optional):</label>
                <textarea name="playlist-description" id="playlist-description" placeholder="Enter description"></textarea>
            </div>
            
            <h3>Add Content</h3>
            
            <div data-role="tabs" id="content-tabs">
                <div data-role="navbar">
                    <ul>
                        <li><a href="#channels-tab" class="ui-btn-active">Channels</a></li>
                        <li><a href="#favorites-tab">Favorites</a></li>
                        <li><a href="#recent-tab">Recent</a></li>
                    </ul>
                </div>
                
                <div id="channels-tab" class="ui-content">
                    <input type="search" id="channel-search" placeholder="Search channels">
                    <ul data-role="listview" data-filter="true" data-input="#channel-search" class="content-list">
                        <!-- Dynamically populated list of channels -->
                        <li>
                            <a href="#" class="add-to-playlist" data-content-id="ch1" data-content-type="channel">
                                <h3>SKY Sport HD1</h3>
                                <p>Channel 221</p>
                            </a>
                        </li>
                        <!-- More channels... -->
                    </ul>
                </div>
                
                <div id="favorites-tab" class="ui-content">
                    <ul data-role="listview" class="content-list">
                        <!-- Dynamically populated list of favorite content -->
                    </ul>
                </div>
                
                <div id="recent-tab" class="ui-content">
                    <ul data-role="listview" class="content-list">
                        <!-- Dynamically populated list of recently viewed content -->
                    </ul>
                </div>
            </div>
            
            <h3>Selected Items <span id="selected-count">(0)</span></h3>
            
            <ul id="selected-items" data-role="listview" data-inset="true">
                <!-- Dynamically populated list of selected items -->
                <!-- Empty state message -->
                <li id="no-items-message">No items selected yet</li>
            </ul>
            
            <div class="ui-grid-a">
                <div class="ui-block-a">
                    <a href="#playlists" data-role="button" data-icon="delete">Cancel</a>
                </div>
                <div class="ui-block-b">
                    <button type="submit" data-icon="check" data-theme="b">Save Playlist</button>
                </div>
            </div>
        </form>
    </article>
</div>
```

### 4. Playlist Detail Page
A page showing the details of a specific playlist with options to play, edit, or delete it.

![Playlist Detail Wireframe](wireframes/playlist-detail.png)

```html
<div data-role="page" id="playlist-detail">
    <header data-role="header">
        <h1 id="detail-playlist-name">Playlist Name</h1>
        <a href="#playlists" data-icon="back" class="ui-btn-left">Back</a>
        <a href="#edit-playlist" data-icon="edit" class="ui-btn-right">Edit</a>
    </header>
    <article data-role="content">
        <div class="playlist-info">
            <p id="detail-playlist-description">Playlist description goes here...</p>
            <p><span id="detail-item-count">0</span> items · <span id="detail-duration">0</span> minutes</p>
        </div>
        
        <div class="ui-grid-a">
            <div class="ui-block-a">
                <a href="#" id="play-playlist" data-role="button" data-icon="play" data-theme="b">Play All</a>
            </div>
            <div class="ui-block-b">
                <a href="#" id="shuffle-playlist" data-role="button" data-icon="refresh">Shuffle</a>
            </div>
        </div>
        
        <ul id="playlist-items" data-role="listview" data-inset="true">
            <!-- Dynamically populated list of playlist items -->
            <li>
                <a href="#" class="play-item" data-item-id="1">
                    <h3>SKY Sport HD1</h3>
                    <p>Channel 221</p>
                </a>
            </li>
            <!-- More items... -->
        </ul>
        
        <div data-role="popup" id="delete-playlist-popup" data-overlay-theme="b" data-theme="b" data-dismissible="false">
            <div data-role="header">
                <h1>Delete Playlist?</h1>
            </div>
            <div role="main" class="ui-content">
                <h3 class="ui-title">Are you sure you want to delete this playlist?</h3>
                <p>This action cannot be undone.</p>
                <div class="ui-grid-a">
                    <div class="ui-block-a">
                        <a href="#" data-role="button" data-rel="back">Cancel</a>
                    </div>
                    <div class="ui-block-b">
                        <a href="#" id="confirm-delete" data-role="button" data-theme="c">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>
```

### 5. Edit Playlist Page
Similar to the create playlist page, but pre-populated with existing playlist data.

![Edit Playlist Wireframe](wireframes/edit-playlist.png)

```html
<div data-role="page" id="edit-playlist">
    <header data-role="header">
        <h1>Edit Playlist</h1>
        <a href="#playlist-detail" data-icon="back" class="ui-btn-left">Back</a>
    </header>
    <article data-role="content">
        <!-- Similar to create-playlist form, but with pre-populated data -->
        <!-- And an additional delete button -->
        <a href="#delete-playlist-popup" data-rel="popup" data-position-to="window" data-role="button" data-icon="delete" data-transition="pop">Delete Playlist</a>
    </article>
</div>
```

## JavaScript Functionality

### 1. Data Structure
Playlists will be stored in the following format:

```javascript
{
    id: "unique-id",
    name: "Playlist Name",
    description: "Optional description",
    created: "2025-05-23T12:00:00Z",
    modified: "2025-05-23T12:00:00Z",
    items: [
        {
            id: "content-id",
            type: "channel", // or "favorite", "program", etc.
            name: "Content Name",
            details: "Additional details",
            duration: 0, // in seconds, if applicable
            position: 0 // for ordering
        },
        // More items...
    ]
}
```

### 2. Core Functions

```javascript
// Initialize playlist functionality
function initPlaylists() {
    loadPlaylists();
    bindPlaylistEvents();
}

// Load playlists from local storage
function loadPlaylists() {
    var playlists = JSON.parse(localStorage.getItem('playlists')) || [];
    renderPlaylistList(playlists);
}

// Save a playlist to local storage
function savePlaylist(playlist) {
    var playlists = JSON.parse(localStorage.getItem('playlists')) || [];
    
    // Update existing or add new
    var existingIndex = playlists.findIndex(p => p.id === playlist.id);
    if (existingIndex >= 0) {
        playlists[existingIndex] = playlist;
    } else {
        playlist.id = generateUniqueId();
        playlist.created = new Date().toISOString();
        playlists.push(playlist);
    }
    
    playlist.modified = new Date().toISOString();
    localStorage.setItem('playlists', JSON.stringify(playlists));
    return playlist;
}

// Delete a playlist
function deletePlaylist(playlistId) {
    var playlists = JSON.parse(localStorage.getItem('playlists')) || [];
    playlists = playlists.filter(p => p.id !== playlistId);
    localStorage.setItem('playlists', JSON.stringify(playlists));
}

// Play a playlist
function playPlaylist(playlistId, shuffle = false) {
    var playlists = JSON.parse(localStorage.getItem('playlists')) || [];
    var playlist = playlists.find(p => p.id === playlistId);
    
    if (!playlist || !playlist.items.length) {
        alert('Playlist is empty or not found.');
        return;
    }
    
    var items = [...playlist.items];
    if (shuffle) {
        // Shuffle the items
        items.sort(() => Math.random() - 0.5);
    }
    
    // Start playing the first item
    playItem(items[0]);
    
    // Store the queue for next/previous navigation
    sessionStorage.setItem('currentQueue', JSON.stringify({
        playlistId: playlistId,
        items: items,
        currentIndex: 0
    }));
}

// Play a specific item
function playItem(item) {
    // Implementation depends on the type of content
    if (item.type === 'channel') {
        // Use existing channel switching functionality
        var link = "http://192.168.2.110/remote/remote.php?channel=" + item.id;
        $.get(link, function(data) {
            console.log('Playing channel: ' + item.name);
        });
    }
    // Handle other content types...
}

// Generate a unique ID for new playlists
function generateUniqueId() {
    return 'playlist_' + Date.now() + '_' + Math.floor(Math.random() * 1000);
}
```

### 3. Event Handlers

```javascript
function bindPlaylistEvents() {
    // Create playlist form submission
    $(document).on('submit', '#playlist-form', function(e) {
        e.preventDefault();
        
        var playlist = {
            name: $('#playlist-name').val(),
            description: $('#playlist-description').val(),
            items: getSelectedItems()
        };
        
        if (!playlist.name) {
            alert('Please enter a playlist name.');
            return;
        }
        
        if (!playlist.items.length) {
            alert('Please add at least one item to the playlist.');
            return;
        }
        
        // If editing, get the existing ID
        var existingId = $(this).data('playlist-id');
        if (existingId) {
            playlist.id = existingId;
        }
        
        savePlaylist(playlist);
        $.mobile.changePage('#playlists');
    });
    
    // Add item to playlist
    $(document).on('click', '.add-to-playlist', function(e) {
        e.preventDefault();
        
        var contentId = $(this).data('content-id');
        var contentType = $(this).data('content-type');
        var contentName = $(this).find('h3').text();
        var contentDetails = $(this).find('p').text();
        
        addItemToSelection({
            id: contentId,
            type: contentType,
            name: contentName,
            details: contentDetails,
            position: getSelectedItems().length
        });
        
        updateSelectedItemsUI();
    });
    
    // Remove item from selection
    $(document).on('click', '.remove-item', function(e) {
        e.preventDefault();
        
        var itemId = $(this).data('item-id');
        removeItemFromSelection(itemId);
        updateSelectedItemsUI();
    });
    
    // Reorder items
    $(document).on('sortupdate', '#selected-items', function(e, ui) {
        updateItemPositions();
    });
    
    // Play playlist
    $(document).on('click', '#play-playlist', function(e) {
        e.preventDefault();
        
        var playlistId = $(this).closest('[data-role="page"]').data('playlist-id');
        playPlaylist(playlistId, false);
    });
    
    // Shuffle playlist
    $(document).on('click', '#shuffle-playlist', function(e) {
        e.preventDefault();
        
        var playlistId = $(this).closest('[data-role="page"]').data('playlist-id');
        playPlaylist(playlistId, true);
    });
    
    // Delete playlist
    $(document).on('click', '#confirm-delete', function(e) {
        e.preventDefault();
        
        var playlistId = $('#playlist-detail').data('playlist-id');
        deletePlaylist(playlistId);
        $.mobile.changePage('#playlists');
    });
}
```

## CSS Styling

```css
/* Playlist specific styles */
.playlist-info {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #f8f8f8;
    border-radius: 5px;
}

#selected-items .ui-icon-arrow-u,
#selected-items .ui-icon-arrow-d {
    margin-top: -10px;
}

.content-list .ui-li-aside {
    margin-top: 0;
}

#selected-count {
    font-size: 0.8em;
    color: #666;
}

#no-items-message {
    color: #999;
    font-style: italic;
}

.playlist-options {
    margin-top: -10px !important;
}

/* Make the tabs more touch-friendly */
#content-tabs .ui-navbar li a {
    padding: 15px 10px;
}

/* Style for the search box */
#channel-search {
    margin-bottom: 10px;
}
```

## Integration with Player UX

The playlist functionality will integrate with the existing player experience in the following ways:

1. **Now Playing Integration**: When a playlist is active, a "Now Playing" indicator will appear in the UI, showing the current item and providing controls to navigate to the next/previous items.

2. **Gesture Support**: Extend the existing swipe gestures to support playlist navigation:
   - Swipe left: Next item in playlist
   - Swipe right: Previous item in playlist
   - Long press: Show playlist details

3. **Remote Control Integration**: Add playlist navigation to the remote control interface:
   - Use existing next/previous buttons for playlist navigation when a playlist is active
   - Add a "Playlist" button to the remote to quickly access the current playlist

4. **Quick Access**: Add a "Recently Played" section to the playlists page for quick access to recently played playlists.

## Responsive Design Considerations

1. **Small Screens (Phones)**:
   - Stack buttons vertically in the playlist detail view
   - Show fewer items per page in lists
   - Simplify the create/edit form to focus on essential fields

2. **Medium Screens (Tablets)**:
   - Show more items per page
   - Use a two-column layout for the create/edit form
   - Show more details for each playlist item

3. **Large Screens (TVs/Desktops)**:
   - Use a three-column layout: playlists, playlist details, and content selection
   - Show thumbnails for content where available
   - Provide more detailed information for each item

## Accessibility Considerations

1. **Keyboard Navigation**: Ensure all interactive elements are keyboard accessible
2. **Screen Reader Support**: Add appropriate ARIA labels and roles
3. **Color Contrast**: Ensure text has sufficient contrast against backgrounds
4. **Touch Targets**: Make buttons and interactive elements large enough for easy tapping
5. **Error Messages**: Provide clear error messages for form validation

## Implementation Phases

### Phase 1: Core Functionality
- Create playlist data structure
- Implement basic CRUD operations for playlists
- Add playlist overview page
- Add create playlist page with basic functionality

### Phase 2: Enhanced Features
- Add playlist detail view
- Implement playlist playback functionality
- Add edit playlist functionality
- Implement item reordering

### Phase 3: UI Polish and Integration
- Enhance responsive design
- Improve animations and transitions
- Integrate with player UX
- Add gesture support

## Testing Criteria

1. **Functionality Testing**:
   - Create, edit, and delete playlists
   - Add and remove items from playlists
   - Play playlists in normal and shuffle modes
   - Navigate between playlist items

2. **Usability Testing**:
   - Test with different user personas
   - Evaluate ease of creating and managing playlists
   - Assess intuitiveness of the UI

3. **Responsive Testing**:
   - Test on different screen sizes
   - Verify layout adjusts appropriately
   - Check touch targets on small screens

4. **Performance Testing**:
   - Test with large playlists
   - Measure load times for playlist data
   - Verify smooth transitions between screens

## Conclusion

This design provides a comprehensive solution for adding playlist creation functionality to the Peacock Remote application. It follows the existing UI patterns and leverages the jQuery Mobile framework while introducing new components specific to playlist management. The design is responsive, accessible, and integrates seamlessly with the existing player experience.

