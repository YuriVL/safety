$(function () {
    function getTree() {
        var directory = $('#tree').data('directory');
        var data = [];
        $.ajax({
            url:'/dashboard/get-tree?directory=' + directory,
            success: function (data) {
                $('#tree').treeview({
                    data: data,
                    enableLinks: true
                });
            },
            error: function (response) {
                console.log(response);
            }
        })
       /* return [
            {
                text: "Parent 1",
                nodes: [
                    {
                        text: "Child 1",
                        nodes: [
                            {
                                text: "Grandchild 1"
                            },
                            {
                                text: "Grandchild 2"
                            }
                        ]
                    },
                    {
                        text: "Child 2"
                    }
                ]
            },
            {
                text: "Parent 2"
            },
            {
                text: "Parent 3"
            },
            {
                text: "Parent 4"
            },
            {
                text: "Node 1",
                icon: "glyphicon glyphicon-stop",
                selectedIcon: "glyphicon glyphicon-stop",
                color: "#000000",
                backColor: "#FFFFFF",
                href: "#node-1",
                selectable: true,
                state: {
                    checked: true,
                    expanded: true,
                    selected: true
                },
                tags: ['available'],

    }
        ];*/
       return data;
    }
    $("[data-toggle='tooltip']").tooltip();
    $("[data-toggle='popover']").popover();

    $('.b-profile').on('click', function () {
        var $this = $(this);
        //$this.find('.b-profile__menu').toggleClass('b-profile__menu_show');
    });
    $(document).ready(function () {
        getTree();
    })
});

