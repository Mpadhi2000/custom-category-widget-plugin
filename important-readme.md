# Custom Category Widget Plugin

**Author**: Mayank Padhi  
**Version**: 1.1  
**Description**: This plugin allows users to display the latest posts from a specific category in the WordPress sidebar, with a custom title, category selection, and number of posts to show.

---

## 📌 What Does This Plugin Do?

After installing and activating this plugin:

- A new widget appears under **Appearance > Widgets** called **“Latest Posts from Category.”**
- You can drag this widget into the **Custom Sidebar** (which is also created by the plugin).
- You can customize:
  - ✅ **The title/heading** of the widget
  - ✅ **The category** you want to display posts from
  - ✅ **The number of posts** to show

It’s designed to work even if your theme does not support widgets by default.

---

## 🚀 How to Install

1. Download the plugin `.zip` file (or copy `custom-category-widget.php` into a new folder named `custom-category-widget`).
2. In your WordPress admin panel:
   - Go to **Plugins > Add New > Upload Plugin**
   - Upload the `.zip` file or folder
3. Click **Activate**

---

## 🛠 How to Use

1. Go to **Appearance > Widgets**
2. Locate the widget titled **“Latest Posts from Category”**
3. Drag it into the **Custom Sidebar** section (created by this plugin)
4. Fill out the following settings:
   - **Title**: This will appear as the widget's heading
   - **Category**: Choose the blog category you want posts from
   - **Number of Posts**: Enter how many recent posts to show
5. Click **Save**

The widget will now appear on your site (if the theme supports sidebar display). You can customize it anytime from the same screen.

---

## ✅ Features at a Glance

| Feature | Description |
|--------|-------------|
| 🎯 Widget Title | Fully editable by the user |
| 📂 Category Selection | Choose any post category |
| 🔢 Post Count | Show 1 or more posts |
| 🧱 Works With Any Theme | Adds widget and sidebar support even for block/FSE themes |
| 👨‍💻 Developer-Friendly | Clean code, fully extendable |

---

## 🧠 For Recruiters & Reviewers

- This plugin is **100% developed from scratch** without relying on external widget plugins.
- It is built to **override missing theme support**, ensuring usability in **modern WordPress (FSE)** as well as classic themes.
- Includes proper use of:
  - WordPress APIs (`register_widget`, `register_sidebar`, `WP_Query`)
  - Widget form fields (with sanitization and validation)
  - `add_filter('use_widgets_block_editor', '__return_false')` to ensure **Widgets menu appears** in **Appearance**

---

