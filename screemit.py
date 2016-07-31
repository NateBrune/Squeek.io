from cursesmenu import *
from cursesmenu.items import *
from piston.steem import Steem
import time
import os
import sys

steem = Steem(wif="YOUR WIF HERE")
menu = CursesMenu("Screem Stream", "main feed for screem")
def main():
    post_status = FunctionItem("Update Status", status, [])
    posts = []
    for post in steem.get_posts(category="tweeter", limit=33, sort="trending"):
        submenu_2 = CursesMenu("Actions Menu", "Post Options")
        function_item_2 = FunctionItem("Up Vote", post.upvote, [])
        item2 = FunctionItem("Down Vote", post.downvote, [])
        submenu_2.append_item(function_item_2)
        submenu_2.append_item(item2)
        posts.append(SubmenuItem(str("@" + post.author + ": " + post.title), submenu=submenu_2))
        posts[len(posts)-1].set_menu(menu)
    menu.append_item(post_status)
    for post in posts:
        menu.append_item(post)
    menu.show()

def status():
    update = input("Status: ")
    try:
        a = steem.post(update, update, category="tweeter")
        #print(a)
        steem.vote("@" + a["operations"][0][1]['author'] + "/" + a["operations"][0][1]['permlink'], 100.0)
        os.execl(sys.executable, sys.executable, *sys.argv)
    except Exception as e:
        menu.pause()
        #cursesmenu.clear_terminal()
        print("An error occured while trying to post status!")
        print("Error Log:")
        print(e)
        time.sleep(3)
        menu.draw()
        menu.resume()

if __name__ == "__main__":
    main()
