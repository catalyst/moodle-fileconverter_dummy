# Dummy Document Converter #

This is a dummy file converter plugin for the Moodle (https://moodle.org)
Learning Management System (LMS). The primary function of this plugin is
to emulate conversion and facilitate Moodle core development.

## Plugin Installation
The following steps will help you to install this plugin into your Moodle instance.

1. Clone or copy the code for this repository into your Moodle instance:
```
git clone git@github.com:catalyst/moodle-fileconverter_dummy.git files/converter/dummy/
```
2. Run the upgrade:
```
php admin/cli/upgrade
```

## Enable Document Converter
The Dummy document converter must be enabled in Moodle. To do this:

1. Log into the Moodle UI as a site administrator;
2. Access *Site administration > Plugins > Document converters >
Manage document converters*;
4. Click the *eye icon* to enable *Dummy Document Converter*;
5. Disable all other converters.

## License ##

Crafted by Cameron Ball <cameronball@catalyst-au.net>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program. If not, see <http://www.gnu.org/licenses/>.
