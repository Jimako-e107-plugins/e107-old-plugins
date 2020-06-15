# The e107 Helper Project v1.1b

## Original Files:
Source: http://bugrain.com/e107_plugins/psilo/psilo.php?artifact.350
Version on e107.org: 0.8

### Description from e107.org:
The e107 Plugin Project is a collection of PHP include files and JavaScript aimed at making plugin writing easier.
The e107 Plugin Project takes the Yourplugin idea a step further and provides the plugin writer with ready written routines that can be called to add new, standard functionality to the plugin. An example of this is adding comments to a plugin, normally this would take around 70 lines of code and is pretty much the same for any plugin apart from a few key values. With the e107 Helper Project comments can be added to a plugin with one line of code - just call the approriate routine, passing in three parameters and your done.

In additon, there are various ad hoc helper methods available. Some are aimed at ensuring that a plugin can run correctly whether a site is running e107 v0.617 or v0.7. In e107 v0.7 some function and method names were changed and some internals have been updated which cause existing plugins to fail under this version. The helper methods used here will determine the version of e107 and call the correct e107 function on behalf of the plugin. Others simply provide a more convenient interface to e107 functionality such as text parsing.

Installation

Installation is the same as any standard e107 plugin - unzip, upload, install.

Also note, main reason for this release is for support for the Contact Form plugin v1.6 (to support custom fields).

It should be backward compatible with all of my plugins that use it. That said, there's no point in downloading it unless you are downloading the Contact Form v1.6 plugin.

Plugin programmers using this plugin may contact me before using but everything should be backward compatible.
Beta version - please report any bugs http://www.bugrain.plus.com