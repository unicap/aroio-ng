################################################################################
#
# perl-template-toolkit
#
################################################################################

PERL_TEMPLATE_TOOLKIT_VERSION = 2.27
PERL_TEMPLATE_TOOLKIT_SOURCE = Template-Toolkit-$(PERL_TEMPLATE_TOOLKIT_VERSION).tar.gz
PERL_TEMPLATE_TOOLKIT_SITE = $(BR2_CPAN_MIRROR)/authors/id/A/AB/ABW
PERL_TEMPLATE_TOOLKIT_DEPENDENCIES = host-perl-cgi perl-appconfig
PERL_TEMPLATE_TOOLKIT_LICENSE = Artistic or GPL-1.0+
PERL_TEMPLATE_TOOLKIT_LICENSE_FILES = README

$(eval $(perl-package))
