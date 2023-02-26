<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Factory\PostFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        PostFactory::createMany(3);
        $post = new Post();
        $post->setTitle('The Gaming Headlines');
        $post->setContent('Before we jump into it, though, I thought I’d chat quickly about what I’ve been playing this week. The game I’ve sunk the most time into has been Hogwarts Legacy which has clearly been resonating with people based on its reported sales numbers. There’s a lot of stuff to talk about and I’ll be tackling them all in my review, so for now I just want to praise Hogwarts castle. The amount of detail and love that Avalanche has poured into every inch of the castle is mindboggling. Every corridor, every room and every hall features a wealth of unique assets that aren’t repeated elsewhere, making it a joy to explore and learn about. As a big book and movie fan, it’s honestly one of the coolest things I’ve experienced in a game.

Outside of the castle, it’s a fairly bog-standard open-world adventure, in many regards, but with a strong combat system that makes good use of the many spells you have at your disposal. In some ways, I was almost expecting a school-life simulator with attending classes being a big part of the game, so I’ve been surprised at how little that stuff matters. There are a few lessons to go to, but you can disappear into the countryside e and none of the teachers seems too worried that you haven’t turned up for classes in a month. Really, you aren’t a Hogwarts student, you’re more like a moocher who occasionally turns up to raid the kitchen and use the beds.

I also found the whole being evil thing kind of funny. On the one hand, it’s pretty clear that Avalanche knew some players were going to want to play the role of a dark wizard or witch, so they played along by letting you learn the unforgivable curses. But they never really follow through on the whole idea: you can murder random people with no repercussions, and you can’t actually be evil in terms of the story and dialogue. At most, you can opt to be mildly passive-aggressive in conversations which comes across as hilarious because of how very polite and very British everyone is. Really, you just come across as a psychopath, one minute demurely talking to professors and the next casting Crucio on a goblin.

The story hasn’t grabbed me, though, which is a shame. I’ll try to explain why in the review but the short version is that the characters are quite one-note and a little dull.');
        $manager->persist($post);

        $post2 = new Post();
        $post2->setTitle('Marvel’s Midnight Suns Review – Marvel’s Poker');
        $post2->setContent('The story focuses on one of the lesser know Marvel teams, The Midnight Suns, an ancient and long-running group that typically deals with the spookier and more magical elements of the Marvel universe and that has a lot of ties to the Spirits of Vengeance. Their line-up tends to include monsters and monster hunters. This incarnation features an eclectic mix of heroes; the half-vampire Blade brings his experience of dealing with things that go bump in the night; Nico, a powerful witch who wields the Staff of One, an awesome tool that lets her do insane things with the caveat that she can’t use a word more than once; Magik, the sister of Colossus and former Queen of Limbo; and Robbie Reyes, the current Ghost Rider. This misfit team of former Runaways, Vampires and flaming skull-heads is led by the Caretaker, a member of the Blood who is hundreds of years old. If you’re a little baffled by all this, that’s perfectly fine.

The events of the plot kick off with the mad Doctor Faustus resurrecting Lillith, The Mother of All Demons, in the hopes of using her to help HYDRA dominate the world, but her arrival actually acts as a trigger of a prophecy that will eventually result in the elder god Chthon returning. To thwart this prophecy the Midnight Suns resurrect Lillith’s child, known only as the Hunter, who defeated his or her mother hundreds of years ago, sacrificing their own life in the process. But to defeat the combined might of Lillith, HYDRA and a looming prophecy the Hunter will have to bring together not only the Midnight Suns, but also a sizable chunk of the Avengers.');
        $manager->persist($post2);

        $post3 = new Post();
        $post3->setTitle('Crossfire: Legion Review – A Forgettable RTS');
        $post3->setContent('God knows they don’t seem interested in helping out newcomers to the Crossfire world, though. The 15-mission campaign immediately hurls you into a futuristic ongoing battle between three factions: Black List, Global Risk and New Horizon, all of whom are battling it out in a dystopian future where huge companies are the dominant forces. Global Risk is the typical corporate military boasting sleek tech in the form of fairly standard tanks and jets. Black List are the scrappy rebels who somehow have access to stealth tech. And finally, New Horizon is a futuristic bunch using fancy AI and stompy mechs.

The action kicks off with you assaulting a series of skyscrapers in a bid to capture valuable data. It’s certainly a fun premise for a mission but at no point does the game try to fill you in on what’s actually going on or why the factions are fighting or even what each faction’s modus operandi is. It really doesn’t get much better: the cutscenes are rendered in a cool visual style and the voice acting is kind of decent thanks to some big names like Ashley Burch and Elias Toufexis, but the game’s in a big rush and doesn’t have time to establish the world, conflict or characters. Who the hell is Viper? Wait, that’s his brother? Who’s that chick? I’m playing as a different faction? Okay, but how are they any different from the other two? And who the hell are these guys!? It makes the attempts at big, dramatic moments laughably bad because who cares when you can’t even remember their names.');
        $manager->persist($post3);

        $manager->flush();
//
//        $this->addReference('post_1', $post);
//        $this->addReference('post_2', $post2);
//        $this->addReference('post_3', $post3);
    }
}
