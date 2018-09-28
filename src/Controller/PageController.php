<?php

namespace App\Controller;

use App\Entity\Talk;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends Controller
{

    /**
     * @return Response
     */
    public function videos()
    {
        $videos = null;
        try {
            $repo = $this->getDoctrine()->getRepository('App:Talk');
            $qb = $repo->createQueryBuilder('a');
            $qb->where($qb->expr()->not($qb->expr()->eq('a.youtubeId', '?1')));
            $qb->setParameter(1, '');

            $videos = $qb->getQuery()
                ->getResult();
        } catch (\Exception $e) {
            $session = $this->get('session');
            $session->getFlashBag()->add(
                'warning',
                "Sorry, we can't access the video storage right now"
            );
        }

        return $this->render(
            'page/videos.html.twig',
            [
                'talksWithVideos' => $videos,
            ]
        );
    }

    /**
     * @return Response
     */
    public function events()
    {
        $talks = null;
        try {
            $repo = $this->getDoctrine()->getRepository(Talk::class);
            $talks = $repo->getUpcomingTalks();
        } catch (\Exception $e) {

            dump($e->getMessage());
            $session = $this->get('session');
            $session->getFlashBag()->add(
                'warning',
                "Sorry, we can't access the meet storage right now"
            );
        }

        return $this->render(
            'events.html.twig',
            [
                'talks' => $talks,
            ]
        );
    }

    /**
     * @param $slug
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function default($slug = '/'): ?Response
    {
        try {
            $slug = $slug === '/' ? 'index' : $slug;

            return $this->render("page/$slug.html.twig");
        } catch (NotFoundHttpException $ex) {

            $message = 'This page does not exist' . PHP_EOL;
            if ($this->container->get('kernel')->getEnvironment() === 'dev') {
                $message .= $ex->getMessage();
            }

            throw $this->createNotFoundException($message);
        }
    }
}
