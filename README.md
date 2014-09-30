espresso
========

Table of Contents
-----------------

- [Introduction](#introduction)
- [Screenshots](#screenshots)
- [Requirements](#requirements)
- [Installation](#installation)
- [Roadmap](#roadmap)
- [Changelog](#changelog)

---

Introduction
------------
espresso is a virtual host manager for the Linux platform. espresso is built with Laravel and PHP Nightrain, making it the perfect companion tool for PHP developers. There is a severe lack of web development tools for Linux - this is meant to help fill that gap.

---

Screenshots
-----------

### Welcome Screen
![Welcome Screen](http://i.imgur.com/XZ8vHVR.png)

### Error Log
![Error Log](http://i.imgur.com/BCx4EEK.png)

---

Requirements
------------
* Linux
* LAMP
* PHP 5 Mcrypt extension

---

Installation
------------

### Installing espresso
Start out by either cloning or downloading the espresso repository to a location where you'd like to house and run it on your local machine.

`cd` into the `www` directory within your terminal. Once here, simply run `composer install` to install the required dependencies.

#### Notice
espresso requires **sudo** to properly run and perform the task of creating virtual hosts on your local machine. Normally this is frowned upon but in this case there's no easy means to *ask* for temporary sudo as espresso is built off of web technologies. The code is also completely open source, so you have complete knowledge of the type of tasks it performs with sudo privilidges.

To run espresso, simply run the following command in your terminal from the root of your espresso folder:

```
sudo ./espresso & disown
```

the `& disown` portion simply allows you to close the terminal after espresso opens without closing espresso with it.

---

Roadmap
-------
The following are the planned features to be developed for each version.

### 1.0
- [x] Create virtual hosts
- [ ] Edit virtual hosts
- [ ] Remove virtual hosts
- [ ] Enable / Disable virtual hosts
- [x] Tail Apache error log
- [ ] Start Apache
- [ ] Stop Apache
- [ ] Restart Apache
- [ ] Reload Apache

---

Changelog
---------

Nothing at the moment.