{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="Roles" icon="la la-question" :link="backpack_url('role')" />
<x-backpack::menu-item title="Shops" icon="la la-question" :link="backpack_url('shop')" />
<x-backpack::menu-item title="Tiles" icon="la la-question" :link="backpack_url('tile')" />
<x-backpack::menu-item title="Invites" icon="la la-question" :link="backpack_url('invite')" />
<x-backpack::menu-item title="Locations" icon="la la-question" :link="backpack_url('location')" />
<x-backpack::menu-item title="Maps" icon="la la-question" :link="backpack_url('map')" />
<x-backpack::menu-item title="Photos" icon="la la-question" :link="backpack_url('photo')" />
<x-backpack::menu-item title="Prefectures" icon="la la-question" :link="backpack_url('prefecture')" />
<x-backpack::menu-item title="Socials" icon="la la-question" :link="backpack_url('social')" />
<x-backpack::menu-item title="Transactions" icon="la la-question" :link="backpack_url('transaction')" />