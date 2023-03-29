#Laragigs

This is a demo job landing site with basic crud operations such as;
    -Create, update, list gigs.
    -User creation, update, authenticate.
    -Manage user actions via user roles and permissions.

Almost all the features have been implemented manually for better understanding of
the concepts. The site is still under construction and will be updated regularly with the time.

##Objective
To share an better understanding on how to organize the implementation. This implementation has been developed from the simplest form and to a more organized and scalable code base. 

##Entity Map

User hasMany (OneToMany)---> Listings

User belongsTo(OneToMany)---> Roles

Roles belongsToMany(ManyToMany)---> Permissions
