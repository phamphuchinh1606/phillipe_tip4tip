<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Home > Dashboard
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Dashboard', '/');
});

// Home > List of Leads
Breadcrumbs::register('leads', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of Leads', route('leads.index'));
});

// Home > List of Leads > Lead detail
Breadcrumbs::register('leads.show', function ($breadcrumbs) {
    $breadcrumbs->parent('leads');
    $breadcrumbs->push('Lead detail', route('leads.index'));
});

// Home > List of Leads > Create Lead
Breadcrumbs::register('leads.create', function ($breadcrumbs) {
    $breadcrumbs->parent('leads');
    $breadcrumbs->push('Create Lead', route('leads.index'));
});

// Home > List of Leads > Edit Lead
Breadcrumbs::register('leads.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('leads');
    $breadcrumbs->push('Edit Lead', route('leads.index'));
});

// Home > List of Leads Deleted
Breadcrumbs::register('leadsDeleted', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of Leads Deleted', route('leads.deleteList'));
});

// Home > List of Leads Deleted > Lead detail
Breadcrumbs::register('leadsDeleted.show', function ($breadcrumbs) {
    $breadcrumbs->parent('leadsDeleted');
    $breadcrumbs->push('Lead detail deleted', route('leads.deleteList'));
});

// Home > List of Tipsters
Breadcrumbs::register('tipsters', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of Tipsters', route('tipsters.index'));
});

// Home > List of Tipsters > Tipster detail
Breadcrumbs::register('tipsters.show', function ($breadcrumbs) {
    $breadcrumbs->parent('tipsters');
    $breadcrumbs->push('Tipster detail', route('tipsters.index'));
});

// Home > List of Tipsters > Create Tipster
Breadcrumbs::register('tipsters.create', function ($breadcrumbs) {
    $breadcrumbs->parent('tipsters');
    $breadcrumbs->push('Create Tipster', route('tipsters.index'));
});

// Home > List of Tipsters > Edit Tipster
Breadcrumbs::register('tipsters.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('tipsters');
    $breadcrumbs->push('Edit Tipster', route('tipsters.index'));
});

// Home > List of Users
Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of Users', route('users.index'));
});

// Home > List of Users > User detail
Breadcrumbs::register('users.show', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Users detail', route('users.index'));
});

// Home > List of Users > Create User
Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Create User', route('users.index'));
});

// Home > List of Users > Edit User
Breadcrumbs::register('users.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Edit User', route('users.index'));
});

// Home > List of Product Categories
Breadcrumbs::register('productcategories', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of Product Categories', route('productcategories.index'));
});
// Home > List of Product Categories > Create product categories
Breadcrumbs::register('productcategories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('productcategories');
    $breadcrumbs->push('Create Product Categories', route('productcategories.index'));
});
// Home > List of Product Categories > Edit Product Categories
Breadcrumbs::register('productcategories.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('productcategories');
    $breadcrumbs->push('Edit Product Categories', route('productcategories.index'));
});

// Home > List of Products
Breadcrumbs::register('products', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of Products', route('products.index'));
});

// Home > List of Products > Product detail
Breadcrumbs::register('products.show', function ($breadcrumbs) {
    $breadcrumbs->parent('products');
    $breadcrumbs->push('Product Information', route('products.index'));
});

// Home > List of Products > Create Product
Breadcrumbs::register('products.create', function ($breadcrumbs) {
    $breadcrumbs->parent('products');
    $breadcrumbs->push('Create Product', route('products.index'));
});

// Home > List of Products > Edit Product
Breadcrumbs::register('products.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('products');
    $breadcrumbs->push('Edit Product', route('products.index'));
});

// Home > List of Gifts
Breadcrumbs::register('gifts', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of Gifts', route('gifts.index'));
});

// Home > List of Gifts > Gift detail
Breadcrumbs::register('gifts.show', function ($breadcrumbs) {
    $breadcrumbs->parent('gifts');
    $breadcrumbs->push('Gift Information', route('gifts.index'));
});

// Home > List of Gifts > Create Gift
Breadcrumbs::register('gifts.create', function ($breadcrumbs) {
    $breadcrumbs->parent('gifts');
    $breadcrumbs->push('Create Gifts', route('gifts.index'));
});

// Home > List of Gifts > Edit Gift
Breadcrumbs::register('gifts.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('gifts');
    $breadcrumbs->push('Edit Gift', route('gifts.index'));
});

// Home > List of Activities
Breadcrumbs::register('activities', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of Activities', route('activities.index'));
});

// Home > Mailbox
Breadcrumbs::register('messages', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Mailbox', route('messages.index'));
});
// Home > Mailbox > Mailbox
Breadcrumbs::register('messages.create', function ($breadcrumbs) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push('Composer new message', route('messages.index'));
});
// Home > Mailbox > Read Mail
Breadcrumbs::register('messages.show', function ($breadcrumbs) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push('Read Mail', route('messages.index'));
});
// Home > Mailbox > Sent Inbox
Breadcrumbs::register('messages.sent', function ($breadcrumbs) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push('Sent Inbox', route('messages.index'));
});
// Home > Mailbox > Trash Inbox
Breadcrumbs::register('messages.trash', function ($breadcrumbs) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push('Trash Inbox', route('messages.index'));
});

// Home > Message Templates
Breadcrumbs::register('messagetemplates', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of Message Templates', route('messagetemplates.index'));
});
// Home > Message Templates > Create message template
Breadcrumbs::register('messagetemplates.create', function ($breadcrumbs) {
    $breadcrumbs->parent('messagetemplates');
    $breadcrumbs->push('Create Message Templates', route('messagetemplates.index'));
});
// Home > Message Templates >
Breadcrumbs::register('messagetemplates.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('messagetemplates');
    $breadcrumbs->push('Edit Message Templates', route('messagetemplates.index'));
});
// Home > Message Templates >
Breadcrumbs::register('messagetemplates.showsendmessage', function ($breadcrumbs) {
    $breadcrumbs->parent('messagetemplates');
    $breadcrumbs->push('Show send message', route('messagetemplates.index'));
});
// Home > Logs Sent Message Templates
Breadcrumbs::register('logssentmessagetemplates', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of logs sent message template', route('logsentmessages.index'));
});


// Home > List of regions
Breadcrumbs::register('regions', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('List of regions', route('regions.index'));
});
// Home > List of regions > Create regions
Breadcrumbs::register('regions.create', function ($breadcrumbs) {
    $breadcrumbs->parent('regions');
    $breadcrumbs->push('Create Region', route('regions.index'));
});
// Home > List of regions > Edit regions
Breadcrumbs::register('regions.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('regions');
    $breadcrumbs->push('Edit Region', route('regions.index'));
});



