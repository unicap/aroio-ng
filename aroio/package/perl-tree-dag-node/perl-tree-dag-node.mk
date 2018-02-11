################################################################################
#
# perl-tree-dag-node
#
################################################################################

PERL_TREE_DAG_NODE_VERSION = 1.30
PERL_TREE_DAG_NODE_SOURCE = Tree-DAG_Node-$(PERL_TREE_DAG_NODE_VERSION).tgz
PERL_TREE_DAG_NODE_SITE = $(BR2_CPAN_MIRROR)/authors/id/R/RS/RSAVAGE
PERL_TREE_DAG_NODE_DEPENDENCIES = perl-file-slurp-tiny
PERL_TREE_DAG_NODE_LICENSE = Artistic or GPL-1.0+
PERL_TREE_DAG_NODE_LICENSE_FILES = LICENSE

$(eval $(perl-package))
