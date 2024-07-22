Git repositories can be accessed from external applications, like (source tree) as well, e.g.: command line git tool (git bash), especially when you want to write something into the repository

If you just want to browse the repository, the phabricator interface is all you need and you can access it at http://encase.phabricator.cut.ac.cy/diffusion/DAL/DataAccessLayer.git

In order to access this git repository from external tool, you have to configure a "VCS Password" first. You can find this in your account settings, in the left menu (Settings -> VCS Password). This password together with your phabricator account name (e.g. firstname.lastname) are all you need to access git complete functionality, besides, of course a git client. 
Developers and developers-like species prefer a command line client to speed things up, but even they, for more complex operations "fall-back" to a graphical user interface; and there are some available: TortoiseGit and SourceTree are maybe the most popular.

Before writing something to git, please do not forget to set your client with a username and an email address. This two informations will appear in the commit logs. If you don't set this, the client will use some default values that it will probably get from your local PC. e.g. username/pcname