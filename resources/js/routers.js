import Router from '../../vendor/tightenco/ziggy/src/js/Router'

export default function ziggyRoute(name, params, absolute, config) {
    const router = new Router(name, params, absolute, config);

    return name ? router.toString() : router;
}
