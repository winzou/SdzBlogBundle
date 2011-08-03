<?php

namespace Sdz\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Sdz\BlogBundle\Entity\Article;
use Sdz\BlogBundle\Form\ArticleType;

class BlogController extends Controller
{
    // Temporaire : nos articles en dur
    private $articles = array();
    
    public function __construct()
    {
        $this->articles = array(
            array('titre' => 'Mon weekend a Phi Phi Island !', 'slug' => 'mon-weekend-a-phi-phi-island', 'auteur' => 'winzou', 'date' => new \Datetime()),
            array('titre' => 'Repetition du National Day de Singapour', 'slug' => 'repetition-du-national-day-de-singapour', 'auteur' => 'winzou', 'date' => new \Datetime()),
            array('titre' => 'Chiffre d\'affaire en hausse', 'slug' => 'chiffre-d-affaire-en-hausse', 'auteur' => 'M@teo21', 'date' => new \Datetime())
        );
    }
    
    // Méthode pour vérifier qu'un article existe
    private function article_existe($slug)
    {
        foreach($this->articles as $article)
        {
            if( $article['slug'] == $slug )
            {
                return $article;
            }
        }
        
        return false;
    }
    
    public function listeAction($page)
    {
        // On ne sait pas combien de pages il y a, mais on sait qu'une page
        // doit être supérieure ou égale à 1.
        if( $page < 1 )
        {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // la page d'erreur 404 (on pourra personnaliser cette page plus tard, d'ailleurs).
            throw new NotFoundHttpException('Page inexistante (page = '.$page.')');
        }

		// Récupération des articles
		$articles = $this->getDoctrine()->getEntityManager()->getRepository('SdzBlogBundle:Article')->findAll();
        
        return $this->render('SdzBlogBundle:Blog:liste.html.twig', array(
            'articles' => $articles
        ));
    }

	// Voir le CookBook sur le DoctrineParamConverter pour comprendre cette syntaxe
    public function voirAction(Article $article)
    {
        return $this->render('SdzBlogBundle:Blog:voir.html.twig', array(
            'article' => $article
        ));
    }

    public function ajouterAction()
    {
        $article = new Article;
        $form = $this->createForm(new ArticleType(), $article);

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bindRequest($request);
            if( $form->isValid() )
            {
                $em = $this->getDoctrine()->getEntityManager();

                $em->persist($article);
                foreach($article->getTags() as $tag)
                {
                    $em->persist($tag);
                }
                $em->flush();

                return $this->redirect( $this->generateUrl('sdzblog') );
            }
        }

        return $this->render('SdzBlogBundle:Blog:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function modifierAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        // On verifie que l'article d'id $id existe bien, sinon erreur 404
        if( ! $article = $em->getRepository('Sdz\BlogBundle\Entity\Article')->find($id) )
        {
            throw new NotFoundHttpException('Article[id='.$id.'] inexistant');
        }

        $form = $this->createForm(new ArticleType(), $article);

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bindRequest($request);
            if( $form->isValid() )
            {
                $em->persist($article);
                foreach($article->getTags() as $tag)
                {
                    $em->persist($tag);
                }
                $em->flush();

                return $this->redirect( $this->generateUrl('sdzblog') );
            }
        }

        return $this->render('SdzBlogBundle:Blog:modifier.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function supprimerAction($id)
    {
        // Ici, on récupérera l'article correspondant à l'$id.

        // Ici, on gérera la suppression de l'article en question.

        return $this->render('SdzBlogBundle:Blog:supprimer.html.twig');
    }
}