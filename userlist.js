document.getElementById("userList").addEventListener("click",function(e) {
	// e.target is our targetted element.

	if(e.target && e.target.nodeName == "li") {
		var node = document.createElement("li");                            // Create a <li> node
        var textnode = document.createTextNode("Water");                    // Create a text node
        node.appendChild(textnode);                                         // Append the text to <li>
        document.getElementById("userList").appendChild(node);      // Append <li> to <ul> with id="selectedUserList
	}
});
