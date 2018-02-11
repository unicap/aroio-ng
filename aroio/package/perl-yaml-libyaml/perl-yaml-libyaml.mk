################################################################################
#
# perl-yaml-libyaml
#
################################################################################

PERL_YAML_LIBYAML_VERSION = 0.69
PERL_YAML_LIBYAML_SOURCE = YAML-LibYAML-$(PERL_YAML_LIBYAML_VERSION).tar.gz
PERL_YAML_LIBYAML_SITE = $(BR2_CPAN_MIRROR)/authors/id/T/TI/TINITA
PERL_YAML_LIBYAML_LICENSE = Artistic or GPL-1.0+
PERL_YAML_LIBYAML_LICENSE_FILES = LICENSE

$(eval $(perl-package))
