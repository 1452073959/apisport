<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection roles
     * @property Grid\Column|Collection permissions
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection user
     * @property Grid\Column|Collection method
     * @property Grid\Column|Collection path
     * @property Grid\Column|Collection ip
     * @property Grid\Column|Collection input
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection alias
     * @property Grid\Column|Collection authors
     * @property Grid\Column|Collection enable
     * @property Grid\Column|Collection imported
     * @property Grid\Column|Collection config
     * @property Grid\Column|Collection require
     * @property Grid\Column|Collection require_dev
     * @property Grid\Column|Collection projectname
     * @property Grid\Column|Collection projectcate
     * @property Grid\Column|Collection city
     * @property Grid\Column|Collection address
     * @property Grid\Column|Collection venue
     * @property Grid\Column|Collection troops
     * @property Grid\Column|Collection smallimg
     * @property Grid\Column|Collection bigimg
     * @property Grid\Column|Collection time
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection cardname
     * @property Grid\Column|Collection deadline
     * @property Grid\Column|Collection price
     * @property Grid\Column|Collection explain
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection open_money
     * @property Grid\Column|Collection open_time
     * @property Grid\Column|Collection end_time
     * @property Grid\Column|Collection member_id
     * @property Grid\Column|Collection avatarurl
     * @property Grid\Column|Collection openid
     * @property Grid\Column|Collection membership
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection email_verified_at
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection venuename
     * @property Grid\Column|Collection label
     * @property Grid\Column|Collection venueimg
     * @property Grid\Column|Collection tel
     * @property Grid\Column|Collection starttime
     * @property Grid\Column|Collection endtime
     * @property Grid\Column|Collection venuesynopsis
     * @property Grid\Column|Collection venuefacility
     * @property Grid\Column|Collection venueserve
     * @property Grid\Column|Collection extra
     * @property Grid\Column|Collection lease
     * @property Grid\Column|Collection memerprice
     * @property Grid\Column|Collection img
     * @property Grid\Column|Collection repertory
     * @property Grid\Column|Collection no
     * @property Grid\Column|Collection ordertitle
     * @property Grid\Column|Collection vid
     * @property Grid\Column|Collection uid
     * @property Grid\Column|Collection money
     * @property Grid\Column|Collection paid_at
     * @property Grid\Column|Collection payment_no
     * @property Grid\Column|Collection invoice
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection sales
     * @property Grid\Column|Collection ship_status
     * @property Grid\Column|Collection ship_data
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection mode
     * @property Grid\Column|Collection s_venue_id
     * @property Grid\Column|Collection r_lease_id
     * @property Grid\Column|Collection code
     * @property Grid\Column|Collection codenot
     *
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection roles(string $label = null)
     * @method Grid\Column|Collection permissions(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection user(string $label = null)
     * @method Grid\Column|Collection method(string $label = null)
     * @method Grid\Column|Collection path(string $label = null)
     * @method Grid\Column|Collection ip(string $label = null)
     * @method Grid\Column|Collection input(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection alias(string $label = null)
     * @method Grid\Column|Collection authors(string $label = null)
     * @method Grid\Column|Collection enable(string $label = null)
     * @method Grid\Column|Collection imported(string $label = null)
     * @method Grid\Column|Collection config(string $label = null)
     * @method Grid\Column|Collection require(string $label = null)
     * @method Grid\Column|Collection require_dev(string $label = null)
     * @method Grid\Column|Collection projectname(string $label = null)
     * @method Grid\Column|Collection projectcate(string $label = null)
     * @method Grid\Column|Collection city(string $label = null)
     * @method Grid\Column|Collection address(string $label = null)
     * @method Grid\Column|Collection venue(string $label = null)
     * @method Grid\Column|Collection troops(string $label = null)
     * @method Grid\Column|Collection smallimg(string $label = null)
     * @method Grid\Column|Collection bigimg(string $label = null)
     * @method Grid\Column|Collection time(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection cardname(string $label = null)
     * @method Grid\Column|Collection deadline(string $label = null)
     * @method Grid\Column|Collection price(string $label = null)
     * @method Grid\Column|Collection explain(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection open_money(string $label = null)
     * @method Grid\Column|Collection open_time(string $label = null)
     * @method Grid\Column|Collection end_time(string $label = null)
     * @method Grid\Column|Collection member_id(string $label = null)
     * @method Grid\Column|Collection avatarurl(string $label = null)
     * @method Grid\Column|Collection openid(string $label = null)
     * @method Grid\Column|Collection membership(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection venuename(string $label = null)
     * @method Grid\Column|Collection label(string $label = null)
     * @method Grid\Column|Collection venueimg(string $label = null)
     * @method Grid\Column|Collection tel(string $label = null)
     * @method Grid\Column|Collection starttime(string $label = null)
     * @method Grid\Column|Collection endtime(string $label = null)
     * @method Grid\Column|Collection venuesynopsis(string $label = null)
     * @method Grid\Column|Collection venuefacility(string $label = null)
     * @method Grid\Column|Collection venueserve(string $label = null)
     * @method Grid\Column|Collection extra(string $label = null)
     * @method Grid\Column|Collection lease(string $label = null)
     * @method Grid\Column|Collection memerprice(string $label = null)
     * @method Grid\Column|Collection img(string $label = null)
     * @method Grid\Column|Collection repertory(string $label = null)
     * @method Grid\Column|Collection no(string $label = null)
     * @method Grid\Column|Collection ordertitle(string $label = null)
     * @method Grid\Column|Collection vid(string $label = null)
     * @method Grid\Column|Collection uid(string $label = null)
     * @method Grid\Column|Collection money(string $label = null)
     * @method Grid\Column|Collection paid_at(string $label = null)
     * @method Grid\Column|Collection payment_no(string $label = null)
     * @method Grid\Column|Collection invoice(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection sales(string $label = null)
     * @method Grid\Column|Collection ship_status(string $label = null)
     * @method Grid\Column|Collection ship_data(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection mode(string $label = null)
     * @method Grid\Column|Collection s_venue_id(string $label = null)
     * @method Grid\Column|Collection r_lease_id(string $label = null)
     * @method Grid\Column|Collection code(string $label = null)
     * @method Grid\Column|Collection codenot(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection id
     * @property Show\Field|Collection username
     * @property Show\Field|Collection name
     * @property Show\Field|Collection roles
     * @property Show\Field|Collection permissions
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection user
     * @property Show\Field|Collection method
     * @property Show\Field|Collection path
     * @property Show\Field|Collection ip
     * @property Show\Field|Collection input
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection version
     * @property Show\Field|Collection alias
     * @property Show\Field|Collection authors
     * @property Show\Field|Collection enable
     * @property Show\Field|Collection imported
     * @property Show\Field|Collection config
     * @property Show\Field|Collection require
     * @property Show\Field|Collection require_dev
     * @property Show\Field|Collection projectname
     * @property Show\Field|Collection projectcate
     * @property Show\Field|Collection city
     * @property Show\Field|Collection address
     * @property Show\Field|Collection venue
     * @property Show\Field|Collection troops
     * @property Show\Field|Collection smallimg
     * @property Show\Field|Collection bigimg
     * @property Show\Field|Collection time
     * @property Show\Field|Collection status
     * @property Show\Field|Collection cardname
     * @property Show\Field|Collection deadline
     * @property Show\Field|Collection price
     * @property Show\Field|Collection explain
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection open_money
     * @property Show\Field|Collection open_time
     * @property Show\Field|Collection end_time
     * @property Show\Field|Collection member_id
     * @property Show\Field|Collection avatarurl
     * @property Show\Field|Collection openid
     * @property Show\Field|Collection membership
     * @property Show\Field|Collection email
     * @property Show\Field|Collection email_verified_at
     * @property Show\Field|Collection password
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection venuename
     * @property Show\Field|Collection label
     * @property Show\Field|Collection venueimg
     * @property Show\Field|Collection tel
     * @property Show\Field|Collection starttime
     * @property Show\Field|Collection endtime
     * @property Show\Field|Collection venuesynopsis
     * @property Show\Field|Collection venuefacility
     * @property Show\Field|Collection venueserve
     * @property Show\Field|Collection extra
     * @property Show\Field|Collection lease
     * @property Show\Field|Collection memerprice
     * @property Show\Field|Collection img
     * @property Show\Field|Collection repertory
     * @property Show\Field|Collection no
     * @property Show\Field|Collection ordertitle
     * @property Show\Field|Collection vid
     * @property Show\Field|Collection uid
     * @property Show\Field|Collection money
     * @property Show\Field|Collection paid_at
     * @property Show\Field|Collection payment_no
     * @property Show\Field|Collection invoice
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection sales
     * @property Show\Field|Collection ship_status
     * @property Show\Field|Collection ship_data
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection token
     * @property Show\Field|Collection mode
     * @property Show\Field|Collection s_venue_id
     * @property Show\Field|Collection r_lease_id
     * @property Show\Field|Collection code
     * @property Show\Field|Collection codenot
     *
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection roles(string $label = null)
     * @method Show\Field|Collection permissions(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection user(string $label = null)
     * @method Show\Field|Collection method(string $label = null)
     * @method Show\Field|Collection path(string $label = null)
     * @method Show\Field|Collection ip(string $label = null)
     * @method Show\Field|Collection input(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection alias(string $label = null)
     * @method Show\Field|Collection authors(string $label = null)
     * @method Show\Field|Collection enable(string $label = null)
     * @method Show\Field|Collection imported(string $label = null)
     * @method Show\Field|Collection config(string $label = null)
     * @method Show\Field|Collection require(string $label = null)
     * @method Show\Field|Collection require_dev(string $label = null)
     * @method Show\Field|Collection projectname(string $label = null)
     * @method Show\Field|Collection projectcate(string $label = null)
     * @method Show\Field|Collection city(string $label = null)
     * @method Show\Field|Collection address(string $label = null)
     * @method Show\Field|Collection venue(string $label = null)
     * @method Show\Field|Collection troops(string $label = null)
     * @method Show\Field|Collection smallimg(string $label = null)
     * @method Show\Field|Collection bigimg(string $label = null)
     * @method Show\Field|Collection time(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection cardname(string $label = null)
     * @method Show\Field|Collection deadline(string $label = null)
     * @method Show\Field|Collection price(string $label = null)
     * @method Show\Field|Collection explain(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection open_money(string $label = null)
     * @method Show\Field|Collection open_time(string $label = null)
     * @method Show\Field|Collection end_time(string $label = null)
     * @method Show\Field|Collection member_id(string $label = null)
     * @method Show\Field|Collection avatarurl(string $label = null)
     * @method Show\Field|Collection openid(string $label = null)
     * @method Show\Field|Collection membership(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection venuename(string $label = null)
     * @method Show\Field|Collection label(string $label = null)
     * @method Show\Field|Collection venueimg(string $label = null)
     * @method Show\Field|Collection tel(string $label = null)
     * @method Show\Field|Collection starttime(string $label = null)
     * @method Show\Field|Collection endtime(string $label = null)
     * @method Show\Field|Collection venuesynopsis(string $label = null)
     * @method Show\Field|Collection venuefacility(string $label = null)
     * @method Show\Field|Collection venueserve(string $label = null)
     * @method Show\Field|Collection extra(string $label = null)
     * @method Show\Field|Collection lease(string $label = null)
     * @method Show\Field|Collection memerprice(string $label = null)
     * @method Show\Field|Collection img(string $label = null)
     * @method Show\Field|Collection repertory(string $label = null)
     * @method Show\Field|Collection no(string $label = null)
     * @method Show\Field|Collection ordertitle(string $label = null)
     * @method Show\Field|Collection vid(string $label = null)
     * @method Show\Field|Collection uid(string $label = null)
     * @method Show\Field|Collection money(string $label = null)
     * @method Show\Field|Collection paid_at(string $label = null)
     * @method Show\Field|Collection payment_no(string $label = null)
     * @method Show\Field|Collection invoice(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection sales(string $label = null)
     * @method Show\Field|Collection ship_status(string $label = null)
     * @method Show\Field|Collection ship_data(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection mode(string $label = null)
     * @method Show\Field|Collection s_venue_id(string $label = null)
     * @method Show\Field|Collection r_lease_id(string $label = null)
     * @method Show\Field|Collection code(string $label = null)
     * @method Show\Field|Collection codenot(string $label = null)
     */
    class Show {}

    /**
     * @method \Dcat\Admin\Form\Field\Button button(...$params)
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
