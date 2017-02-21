## Renaming Projects

Really simple, but I spent some time not bothering to rename things because I was unnecessarily afraid of messing things up in Xcode.

First, open up the 'navigator' in Xcode. This is the menu on the left hand of the screen that shows the files that belong to your project. Click (and then click again) to rename this file.

Next, you want to rename your schemes. The schemes are where you define the targets to build, but for now it's not really important to understand. You might see something like "ofapp Debug" in the upper left. Click and go to "Manage Schemes". Here you will see a couple rows with the previous name. Update these.

If you have an issue running your project now, go back to your schemes, go to 'edit', and make sure that the target of your Debug and Release schemes point to your new .app file.