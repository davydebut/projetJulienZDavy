<form class="d-flex" action="<?= esc_url(home_url('/')) ?>">
    <input class="form-control mr-sm-2 me-2" name="s" type="search" placeholder="recherche" aria-label="Search" value="<?= get_search_query(); ?>">
    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">rechercher</button>
</form>